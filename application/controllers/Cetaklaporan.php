<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetaklaporan extends CI_Controller {
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
	

	public function index()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==3 || $this->session->userdata('role')==2) {
				$data['title'] = "Dashboard - Cetak Laporan";
				$data['user'] = $this->m_petugas->get_petugas();					
				$this->load->view('newtemplate/header',$data);
				$this->load->view('newtemplate/top', $data);
				$this->load->view('newtemplate/sidebar',$data);
				$this->load->view('admin/cetaklaporan',$data);
				$this->load->view('newtemplate/footer',$data);
			} else {
				$this->load->view('error/403');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
	public function create_laporan()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==3 || $this->session->userdata('role')==2) {
				$this->form_validation->set_rules('jns_transaksi','Transaksi','required|trim',
				array('required'=>'Pilih jenis transaksi')
				);
				$this->form_validation->set_rules('tgl_awal','Tanggal Awal','required|trim',
				array('required'=>'Pilih tanggal')
				);
				$this->form_validation->set_rules('tgl_akhir','Tanggal Akhir','required|trim',
				array('required'=>'Pilih tanggal')
				);
				if ($this->form_validation->run() == false) {
					$data['title'] = "Dashboard - Cetak Laporan";
					$data['user'] = $this->m_petugas->get_petugas();					
					$this->load->view('newtemplate/header',$data);
					$this->load->view('newtemplate/top', $data);
					$this->load->view('newtemplate/sidebar',$data);
					$this->load->view('admin/cetaklaporan',$data);
					$this->load->view('newtemplate/footer',$data);
				} else {
					$jenis = $this->input->post('jns_transaksi');
					$awal = $this->input->post('tgl_awal');
					$akhir = $this->input->post('tgl_akhir');
				}
			} else {
				$this->load->view('error/403');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
}
