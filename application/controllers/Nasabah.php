<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nasabah extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('m_nasabah');
		$this->load->model('m_user');                 
		$this->load->model('m_petugas');
		$this->load->model('m_setoran');
		$this->load->model('m_penarikan');
		date_default_timezone_set('Asia/Jakarta');
	}
	

	public function dashboard()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==1) {
				$data['title'] = "Dashboard - Home Nasabah";
				$data['nasabah'] = $this->m_user->get_nasabah();
				$this->load->view('usertemplate/header',$data);
				$this->load->view('usertemplate/top',$data);
				$this->load->view('usertemplate/sidebar',$data);
				$this->load->view('nasabah/dashboard',$data);
			} else {
				redirect('/index.php/auth/dashboard');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
	public function setoran_saya()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==1) {
				$nin = $this->session->userdata('nin');
				$data['title'] = "Dashboard - Setoran Saya";
				$data['nasabah'] = $this->m_user->get_nasabah();
				$data['setoran'] = $this->m_setoran->tampil_databyNin($nin)->result();
				$data['penarikan'] = $this->m_penarikan->tampil_databyNin($nin)->result();
				$this->load->view('usertemplate/header',$data);
				$this->load->view('usertemplate/top',$data);
				$this->load->view('usertemplate/sidebar',$data);
				$this->load->view('nasabah/mytransaksi',$data);
				$this->load->view('usertemplate/footer',$data);
			} else {
				redirect('/index.php/auth/dashboard');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
	public function detail_setoran()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==1) {
				$id_setor = $this->input->post('id_setor');
				$data['title'] = "Dashboard - Detail Setoran Saya";
				$data['nasabah'] = $this->m_user->get_nasabah();
				$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
				$data['setoran'] = $this->m_setoran->get_nasabah($id_setor);
				$data['detail'] = $this->m_setoran->tampil_detail($id_setor)->result();
				$data['id_setor'] = $id_setor;
				$this->load->view('usertemplate/header',$data);
					$this->load->view('usertemplate/top',$data);
					$this->load->view('usertemplate/sidebar',$data);
					$this->load->view('nasabah/setorandetail',$data);
					$this->load->view('usertemplate/footer');
			} else {
				redirect('/index.php/auth/dashboard');
			}
		} else {	
			redirect('/index.php/auth');
		}
	}
}
