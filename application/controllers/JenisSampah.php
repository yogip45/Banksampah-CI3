<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisSampah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		cek_petugas();
		$this->load->model('m_jns_sampah');
		$this->load->library('session');
		$this->load->model('m_nasabah');
		$this->load->model('m_user');
		$this->load->model('m_stok');
	}
	public function index()
	{
		$this->load->model('m_jns_sampah');
		$data['title'] = 'Dashboard - Data Sampah';
		$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
		$data['user'] = $this->m_user->get_user();
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar', $data);
		$this->load->view('sampah/jns_sampah', $data);
		$this->load->view('newtemplate/footer');
	}

	public function tambah_aksi()
	{
		$this->load->model('M_jns_sampah');
		$nama_sampah = $this->input->post('nama_sampah');
		$harga = $this->input->post('harga');
		$kategori = $this->input->post('kategori');
		$id_sampah = getAutoNumber('jns_sampah', 'id_sampah', 'S', '5');
		$id_stok = getAutoNumber('tb_stok', 'id_stok', 'BK', '5');

		$data = array(
			'id_sampah' => $id_sampah,
			'nama_sampah' => $nama_sampah,
			'harga' => $harga,
			'satuan' => 'Kg',
			'kategori' => $kategori,
		);
		$data1 = array(
			'id_stok' => $id_stok,
			'id_sampah' => $id_sampah,
			'jumlah' => 0,
		);

		$this->m_jns_sampah->input_data($data, 'jns_sampah');
		$this->m_stok->input_data($data1, 'tb_stok');

		$this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
		redirect('index.php/jenissampah/index');
	}
	public function hapus($id_sampah)
	{
		$stok_data = $this->m_stok->get_stok($id_sampah);

		if ($stok_data->jumlah == 0) {
			$where = array('id_sampah' => $id_sampah);
			$this->m_jns_sampah->hapus_data($where, 'jns_sampah');
			$this->m_stok->hapus_data($where, 'tb_stok');
			$this->session->set_flashdata('hapus', 'Data Berhasil Dihapus');
			redirect('index.php/jenissampah/index');
		} else {
			// Jika jumlah != 0, redirect dengan pesan
			$this->session->set_flashdata('gagal', 'Stok sampah tidak kosong, tidak bisa menghapus data.');
			redirect('index.php/jenissampah/index');
		}
	}
	public function edit($id)
	{
		$data['title'] = 'Dashboard - Edit Sampah';
		$where = array('id_sampah' => $id);
		$data['jns_sampah'] = $this->m_jns_sampah->edit_data($where, 'jns_sampah')->result();
		$data['user'] = $this->m_user->get_user();
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar');
		$this->load->view('sampah/edit_sampah', $data);
		$this->load->view('newtemplate/footer');
	}

	public function update($id_sampah)
	{
		$id = $id_sampah;
		$nama_sampah = $this->input->post('nama_sampah');
		$harga = $this->input->post('harga');
		$kategori = $this->input->post('kategori');

		$data = array(
			'nama_sampah' => $nama_sampah,
			'harga' => $harga,
			'kategori' => $kategori,
		);

		$where = array(
			'id_sampah' => $id
		);

		$this->m_jns_sampah->update_data($where, $data, 'jns_sampah');
		$this->session->set_flashdata('sukses', 'Data Berhasil Diedit');
		redirect('index.php/jenissampah/index');
	}
}
