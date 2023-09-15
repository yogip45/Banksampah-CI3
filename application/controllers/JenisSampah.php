<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisSampah extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('m_jns_sampah');
		$this->load->library('session');
		$this->load->model('m_nasabah');
		$this->load->model('m_user');                     
	}
	public function index()
	{
		if ($this->session->userdata('email')) {
			$this->load->model('m_jns_sampah');
			$data['title'] = 'Dashboard - Data Sampah';
			$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
			$data['user'] = $this->m_user->get_user();
			$this->load->view('newtemplate/header', $data);
			$this->load->view('newtemplate/top', $data);
			$this->load->view('newtemplate/sidebar', $data);
			$this->load->view('sampah/jns_sampah', $data);
			$this->load->view('newtemplate/footer');
		} else {
			$this->session->set_flashdata('message','Login dulu');
			redirect('index.php/auth');
		}			
	}

	public function tambah_aksi()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2||$this->session->userdata('role')==3) {
				$this->load->model('M_jns_sampah');
				$nama_sampah = $this->input->post('nama_sampah');
				$harga = $this->input->post('harga');
				$kategori = $this->input->post('kategori');
			
				$data = array(
				'nama_sampah' => $nama_sampah,
				'harga' => $harga,
				'satuan' => 'Kg',
				'kategori' => $kategori,
				);
			
				$this->m_jns_sampah->input_data($data,'jns_sampah');
				$this->session->set_flashdata('sukses','Data Berhasil Ditambahkan');
				redirect('index.php/jenissampah/index');
				} else {
					$this->load->view('index.php/error/403');
				}
		} else {
			$this->session->set_flashdata('message','Login dulu');
			redirect('index.php/auth');
		}
	}
	public function hapus($id)
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2||$this->session->userdata('role')==3) {				
				$where = array ('id'=>$id);
				$this->m_jns_sampah->hapus_data($where, 'jns_sampah');
				$this->session->set_flashdata('hapus','Data Berhasil Dihapus');
				redirect('index.php/jenissampah/index');
			} else {
				$this->load->view('index.php/error/403');
			}
		} else {
			redirect('index.php/auth');
		}
	}
	public function edit($id)
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2||$this->session->userdata('role')==3) {
				$data['title'] = 'Dashboard - Edit Sampah';
				$where = array('id'=>$id);		
				$data['jns_sampah'] = $this->m_jns_sampah->edit_data($where, 'jns_sampah')->result();
				$data['user'] = $this->m_user->get_user();
				$this->load->view('newtemplate/header',$data);
				$this->load->view('newtemplate/top',$data);
				$this->load->view('newtemplate/sidebar');
				$this->load->view('sampah/edit_sampah', $data);
				$this->load->view('newtemplate/footer');

			} else {
				$this->load->view('error/403');
			}			
		} else {
			redirect('index.php/auth');
		}
	}

	public function update()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2||$this->session->userdata('role')==3) {
				$id = $this->input->post('id');
				$nama_sampah = $this->input->post('nama_sampah');
				$harga = $this->input->post('harga');
				$kategori = $this->input->post('kategori');

				$data = array(
					'nama_sampah'=> $nama_sampah,
					'harga'=> $harga,
					'kategori'=> $kategori,
				);

				$where = array(
					'id'=>$id
				);

				$this->m_jns_sampah->update_data($where,$data,'jns_sampah');
				$this->session->set_flashdata('sukses','Data Berhasil Diedit');
				redirect('index.php/jenissampah/index');
			} else {
				$this->load->view('index.php/error/403');
			}			
		} else {
			redirect('index.php/auth');
		}
	}
}
