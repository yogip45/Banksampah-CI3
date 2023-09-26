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
				$this->load->view('usertemplate/header',$data);
				$this->load->view('usertemplate/top',$data);
				$this->load->view('usertemplate/sidebar',$data);
				$this->load->view('nasabah/setoranindex',$data);
				$this->load->view('usertemplate/footer',$data);
			} else {
				redirect('/index.php/auth/dashboard');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
}
