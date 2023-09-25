<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setoran extends CI_Controller {
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
		date_default_timezone_set('Asia/Jakarta');
	}
	public function setoranindex()
	{
			if ($this->session->userdata('email')) {
				if ($this->session->userdata('role')==2 || $this->session->userdata('role')==3) {
					$data['title'] = "Dashboard - Data Setoran";
					$data['user'] = $this->m_user->get_user();
					$data['setoran'] = $this->m_setoran->tampil_data()->result();
					$data['nasabah'] = $this->m_nasabah->tampil_data()->result();
					$this->load->view('newtemplate/header',$data);
					$this->load->view('newtemplate/top',$data);
					$this->load->view('newtemplate/sidebar',$data);
					$this->load->view('transaksi/setoranindex',$data);	
					$this->load->view('newtemplate/footer');
				} else {
					$this->load->view('error/403');
				}
			} else {			
				redirect('/index.php/auth');
			}				
	}
	public function pernasabah()
	{
			if ($this->session->userdata('email')) {
				if ($this->session->userdata('role')==2 || $this->session->userdata('role')==3) {
					$keyword = $this->input->post('keyword');
					$data['title'] = "Dashboard - Data Transaksi Nasabah";
					$data['transaksi'] = $this->m_setoran->get_keyword($keyword);
					$data['user'] = $this->m_user->get_user();
					// $data['nasabah'] = $this->m_setoran->tampil_data()->result();
					$data['nasabah'] = $this->m_nasabah->tampil_data()->result();
					$this->load->view('newtemplate/header',$data);
					$this->load->view('newtemplate/top',$data);
					$this->load->view('newtemplate/sidebar',$data);
					$this->load->view('transaksi/pernasabah',$data);	
					$this->load->view('newtemplate/footer',$data);

				} else {
					$this->load->view('error/403');
				}
			} else {			
				redirect('/index.php/auth');
			}				
	}
	public function detail_setoran($id_setor)
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==3 || $this->session->userdata('role')==2 ) {
				$data['title'] = "Dashboard - Form Detail Setoran";
				$data['user'] = $this->m_user->get_user();
				$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
				$data['nasabah'] = $this->m_setoran->get_nasabah($id_setor);
				$data['detail'] = $this->m_setoran->tampil_detail($id_setor)->result();
				$data['id_setor'] = $id_setor;
				$this->load->view('newtemplate/header',$data);
					$this->load->view('newtemplate/top',$data);
					$this->load->view('newtemplate/sidebar',$data);
					$this->load->view('transaksi/setorandetail',$data);
					$this->load->view('newtemplate/footer');
			} else {
				$this->load->view('error/403');
			}
		} else {	
			redirect('/index.php/auth');
		}
	}
	public function selesaitransaksi()
	{
		$this->load->model('m_setoran');
		$id_setor = $this->input->post('id_setor');
		$total = $this->input->post('total');
		$nin = $this->input->post('nin');
		$new_status = 1; // Ganti dengan status yang ingin Anda set
		$result = $this->m_setoran->selesaiTransaksi($id_setor, $new_status,$total,$nin);
		$this->m_setoran->updateSaldo($nin,$total);
		if ($result) {
			echo json_encode(array('status' => 'success'));
			$this->session->set_flashdata('sukses','Transaksi ' . $id_setor . ' Selesai');
		} else {
			echo json_encode(array('status' => 'error'));
			$this->session->set_flashdata('gagal','Transaksi ' . $id_setor . ' Gagal');
		}
	}

	public function create_setoran()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2||$this->session->userdata('role')==3) {
				
				$this->load->model('m_nasabah');
				$this->load->model('m_jns_sampah');				
		
				$this->form_validation->set_rules('nin','Nin','required|trim',
				array('required'=>'Nomor Induk Harus Diisi')
				);
				$this->form_validation->set_rules('nama','No_hp','required|trim',
				array('required'=>'Nama Harus Diisi')
				);								
				if ($this->form_validation->run() == false) {
					$data['title'] = "Dashboard - Data Setoran";
						$data['user'] = $this->m_user->get_user();
						// $data['nasabah'] = $this->m_nasabah->tampil_data()->result();
						$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
						redirect('index.php/setoran/setoranindex');
				} else {
					$id_setor = getAutoSetoranId();
					$nin = $this->input->post('nin');
					$id_admin = $this->session->userdata('id_user');
					$data = array(
						'id_setor' => $id_setor,
						'nin' => $nin,
						'id_admin' => $id_admin,
					);
					$this->m_setoran->input_setoran($data,$id_setor);
					redirect('index.php/setoran/setoranindex');
				}
			} else {
				$this->load->view('error/403');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
	public function create_detail()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2||$this->session->userdata('role')==3) {
				
				$this->load->model('m_nasabah');
				$this->load->model('m_jns_sampah');
				$id_setor = $this->input->post('id_setor');
					// $data['nasabah'] = $this->m_setoran->get_nasabah($id_setor);
					$jns_sampah = $this->input->post('jenis_sampah');
					$berat = $this->input->post('berat');
					$harga = $this->input->post('harga');
					$total = $this->input->post('total');
					$data = array(

						'id_setor' => $id_setor,
						'jns_sampah' => $jns_sampah,
						'berat' => $berat,
						'harga' => $harga,
						'total' => $total,
					);
					$this->m_setoran->input_detail($data,$id_setor);
					redirect('index.php/setoran/setoranindex');
				
			} else {
				$this->load->view('error/403');
			}
		} else {
			redirect('/index.php/auth');
		}
	}

	public function search()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2||$this->session->userdata('role')==3) {

				$this->load->model('m_setoran');
				$keyword = $this->input->post('keyword');
				$nama = $this->input->post('nama');		
				$data['transaksi'] = $this->m_setoran->get_keyword($keyword);
		
				$this->session->set_flashdata('nama', $nama);
				$this->session->set_flashdata('keyword', $keyword);
		
				$data['title'] = "Dashboard - Data Transaksi Nasabah";
				$data['nasabah'] = $this->m_nasabah->tampil_data()->result();
							$data['user'] = $this->m_user->get_user();
							$this->load->view('newtemplate/header',$data);
							$this->load->view('newtemplate/top',$data);
							$this->load->view('newtemplate/sidebar',$data);
							$this->load->view('transaksi/pernasabah',$data);
							$this->load->view('newtemplate/footer',$data);
			} else {
				$this->load->view('error/403');				
			}
		} else {
			redirect('/index.php/auth');			
		}
	}


}
