<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penarikan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('m_nasabah');
		$this->load->model('m_petugas');
		$this->load->model('m_user');                  
		$this->load->model('m_jns_sampah');
		$this->load->model('m_setoran');
		$this->load->model('m_stok');
		$this->load->model('m_penarikan');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function penarikanindex()
	{
			if ($this->session->userdata('email')) {
				if ($this->session->userdata('role')==2 || $this->session->userdata('role')==3) {
					$data['title'] = "Dashboard - Data Penarikan";
					$data['user'] = $this->m_user->get_user();
					$data['nasabah'] = $this->m_nasabah->tampil_data()->result();
					$data['penarikan'] = $this->m_penarikan->tampil_data()->result();
					$this->load->view('newtemplate/header',$data);
					$this->load->view('newtemplate/top',$data);
					$this->load->view('newtemplate/sidebar',$data);
					$this->load->view('transaksi/penarikanindex',$data);	
					$this->load->view('newtemplate/footer');
				} else {
					$this->load->view('error/403');
				}
			} else {			
				redirect('/index.php/auth');
			}				
	}
	public function getdata_nasabah()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2 || $this->session->userdata('role')==3) {
				$nin = $this->input->post('nin');
				$data_nasabah = $this->m_penarikan->getdata_nasabah($nin);
				echo json_encode($data_nasabah);
			} else {
				$this->load->view('error/403');
			}
		} else {			
			redirect('/index.php/auth');
		}

	}
	public function create_penarikan()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2 || $this->session->userdata('role')==3) {
				$this->form_validation->set_rules('nin','Nin','required|trim',
				array('required'=>'Nin Harus Diisi')
				);
				$this->form_validation->set_rules('nama','Nama','required|trim',
				array('required'=>'Nama Harus Diisi')
				);
				$this->form_validation->set_rules('saldo','Saldo','required|trim',
				array('required'=>'Saldo Harus Diisi')
				);
				$nin = $this->input->post('nin');
				$this->form_validation->set_rules('jumlah_penarikan','Jumlah','required|trim|callback_compare_with_saldo['.$nin.']',
					array('required'=>'Masukan nominal penarikan')
				);
				if ($this->form_validation->run() == true) {
					try {
						$id_penarikan = getAutoNumber('tb_penarikan','id_penarikan','PN','6');
						$nin = $this->input->post('nin');
						$saldo = $this->input->post('saldo');
						$jumlah_penarikan = $this->input->post('jumlah_penarikan');
						$success = true;
						$data = array(
							'id_penarikan' => $id_penarikan,
							'nin' => $nin,
							'saldo' => $saldo,
							'jumlah_penarikan' => $jumlah_penarikan,
							'status' => 0,
							'id_petugas' => $this->session->userdata('id_user'),
						);
							$success = $this->m_penarikan->input_penarikan($data) && $this->m_penarikan->ambil_saldo($jumlah_penarikan, $nin);
							if ($success) {
									$this->session->set_flashdata('sukses', 'Berhasil Ditambahkan');
							} else {
									throw new Exception('Gagal menambahkan data.');
							}
					} catch (Exception $e) {
							$this->session->set_flashdata('gagal', $e->getMessage());
					}
					redirect('index.php/penarikan/penarikanindex');
				} else {
					$data['title'] = "Dashboard - Data Penarikan";
					$data['user'] = $this->m_user->get_user();
					$data['nasabah'] = $this->m_nasabah->tampil_data()->result();
					$data['penarikan'] = $this->m_penarikan->tampil_data()->result();
					$this->load->view('newtemplate/header',$data);
					$this->load->view('newtemplate/top',$data);
					$this->load->view('newtemplate/sidebar',$data);
					$this->load->view('transaksi/penarikanindex',$data);	
					$this->load->view('newtemplate/footer');
				}
			} else {
				$this->load->view('error/403');
			}
		} else {			
			redirect('/index.php/auth');
		}
	}
	public function compare_with_saldo($input,$nin)
	{
		if ($nin != NULL) {
			$this->load->model('m_penarikan');
			$saldo_value = $this->m_penarikan->get_saldo($nin);
				if ((int)$input > $saldo_value['saldo']) {
						$this->form_validation->set_message('compare_with_saldo', 'Saldo Tidak Mencukupi');
						return false;
					} else {
					return true;
			}
		}
	}

	public function konfirmasi($id_penarikan)
	{
		if ($this->m_penarikan->konfirmasiPenarikan($id_penarikan)) {
				$this->session->set_flashdata('sukses', 'Konfirmasi berhasil.');
		} else {
				$this->session->set_flashdata('gagal', 'Konfirmasi gagal.');
		}
		redirect('/index.php/nasabah/setoran_saya#tab_2');
	}

}
