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
					$data['nasabah'] = $this->m_setoran->tampil_data()->result();
					$this->load->view('template/header',$data);
					$this->load->view('template/top',$data);
					$this->load->view('template/sidebar',$data);
					$this->load->view('transaksi/setoranindex',$data);	
				} else {
					$this->load->view('error/403');
				}
			} else {			
				redirect('/index.php/auth');
			}				
	}
	public function tambah_setoran()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==3 || $this->session->userdata('role')==2 ) {
				$data['title'] = "Dashboard - Form Tambah Setoran";
				$data['user'] = $this->m_user->get_user();
				$data['nasabah'] = $this->m_nasabah->tampil_data()->result();
				$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
				$this->load->view('template/header',$data);
				$this->load->view('template/top',$data);
				$this->load->view('template/sidebar',$data);
				$this->load->view('transaksi/setorantambah',$data);
			} else {
				$this->load->view('error/403');
			}
		} else {	
			redirect('/index.php/auth');
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
				$this->form_validation->set_rules('harga','Harga','required|trim',
				array('required'=>'Harga Harus Diisi')
				);		
				$this->form_validation->set_rules('berat','Berat','required|trim',
				array('required'=>'Berat Sampah Harus Diisi')
				);
				if ($this->form_validation->run() == false) {
					$data['title'] = "Dashboard - Form Tambah Setoran";
						$data['user'] = $this->m_user->get_user();
						$data['nasabah'] = $this->m_nasabah->tampil_data()->result();
						$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
						$this->load->view('template/header',$data);
						$this->load->view('template/top',$data);
						$this->load->view('template/sidebar',$data);
						$this->load->view('transaksi/setorantambah',$data);
				} else {
					$id_setor = getAutoNumber('tb_setoran','id_setor','ST-','10');
					$nin = $this->input->post('nin');
					$jenis_sampah = $this->input->post('jenis_sampah');
					$berat	 = $this->input->post('berat');
					$harga	 = $this->input->post('harga');
					$total	 = $this->input->post('harga') * $berat;
					$id_admin = $this->session->userdata('id_user');
		
					$data = array(
						'id_setor' => $id_setor,
						'nin' => $nin,
						'jenis_sampah' => $jenis_sampah,
						'berat' => $berat,
						'harga' => $harga,
						'total' => $total,
						'id_admin' => $id_admin,
					);
					$this->m_setoran->input_data($data,'tb_setoran');					
				}
			} else {
				$this->load->view('error/403');
			}
		}
	}	


}
