<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setoran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		cek_petugas();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('m_nasabah');
		$this->load->model('m_petugas');
		$this->load->model('m_user');
		$this->load->model('m_jns_sampah');
		$this->load->model('m_setoran');
		$this->load->model('m_penarikan');
		$this->load->model('m_stok');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function setoranindex()
	{
		$data['title'] = "Dashboard - Data Setoran";
		$data['user'] = $this->m_user->get_user();
		$data['setoran'] = $this->m_setoran->tampil_data()->result();
		$data['nasabah'] = $this->m_nasabah->tampil_data();
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar', $data);
		$this->load->view('transaksi/setoranindex', $data);
		$this->load->view('newtemplate/footer');
	}
	public function search()
	{
		$keyword = $this->input->post('keyword');
		$data['title'] = "Dashboard - Data Transaksi Nasabah";
		// $data['transaksi'] = $this->m_setoran->get_keyword($keyword);
		$data['user'] = $this->m_user->get_user();
		$data['nama'] = null;
		$data['keyword'] = null;
		$data['setoran'] = null;
		$data['riwayat_transaksi'] = null;
		$data['nasabah'] = $this->m_nasabah->tampil_data();
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar', $data);
		$this->load->view('transaksi/pernasabah', $data);
		$this->load->view('newtemplate/footer', $data);
	}
	public function history()
	{
		$keyword = $this->input->post('keyword');
		$nama = $this->input->post('nama');
		$data['title'] = "Dashboard - Data Transaksi Nasabah";
		$data['setoran'] = null;
		$data['riwayat_transaksi'] = $this->m_setoran->get_keyword($keyword);
		$data['title'] = "Dashboard - Riwayat Transaksi Nasabah";
		$data['nasabah'] = $this->m_nasabah->tampil_data();
		$data['nama'] = $nama;
		$data['keyword'] = $keyword;
		$data['user'] = $this->m_user->get_user();
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar', $data);
		$this->load->view('transaksi/riwayat', $data);
		$this->load->view('newtemplate/footer', $data);
	}
	public function detail_setoran($id_setor)
	{
		$data['title'] = "Dashboard - Form Detail Setoran";
		$data['user'] = $this->m_user->get_user();
		$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
		$data['nasabah'] = $this->m_setoran->get_nasabah($id_setor);
		$data['detail'] = $this->m_setoran->tampil_detail($id_setor)->result();
		$data['id_setor'] = $id_setor;
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar', $data);
		$this->load->view('transaksi/setorandetail', $data);
		$this->load->view('newtemplate/footer');
	}
	public function selesaitransaksi()
	{
		$this->load->model('m_setoran');
		$id_setor = $this->input->post('id_setor');
		$total = $this->input->post('total');
		$nin = $this->input->post('nin');
		$new_status = 1;
		$result = $this->m_setoran->selesaiTransaksi($id_setor, $new_status, $total, $nin);
		if ($result) {
			$sampah_ids = $this->m_stok->getUniqueSampahIds();
			foreach ($sampah_ids as $id_sampah) {
				// Hitung total berat untuk id_sampah tertentu
				$total_berat = $this->m_stok->hitungTotalBeratByIdSampah($id_sampah);
				// Update kolom 'berat' di tb_stok dengan total berat yang baru
				$this->m_stok->updateBeratByIdSampah($id_sampah, $total_berat);
			}
			$this->m_setoran->updateSaldo($nin, $total);
			echo json_encode(array('status' => 'success'));
			$this->session->set_flashdata('sukses', 'Transaksi ' . $id_setor . ' Selesai');
		} else {
			echo json_encode(array('status' => 'error'));
			$this->session->set_flashdata('gagal', 'Transaksi ' . $id_setor . ' Gagal');
		}
	}

	public function create_setoran()
	{

		$this->load->model('m_nasabah');
		$this->load->model('m_jns_sampah');

		$this->form_validation->set_rules(
			'nin',
			'Nin',
			'required|trim',
			array('required' => 'Nomor Induk Harus Diisi')
		);
		$this->form_validation->set_rules(
			'nama',
			'No_hp',
			'required|trim',
			array('required' => 'Nama Harus Diisi')
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
			$saldo_lama = $this->m_nasabah->getSaldoByNin($nin);
			$id_admin = $this->session->userdata('id_user');
			$data = array(
				'id_setor' => $id_setor,
				'nin' => $nin,
				'id_admin' => $id_admin,
				'saldo_lama' => $saldo_lama,
			);
			$this->m_setoran->input_setoran($data, $id_setor);
			redirect('index.php/setoran/setoranindex');
		}
	}
	public function create_detail()
	{
		$this->load->model('m_nasabah');
		$this->load->model('m_jns_sampah');
		$this->load->model('m_stok');
		$id_setor = $this->input->post('id_setor');
		$jns_sampah = $this->input->post('jenis_sampah');
		$berat = $this->input->post('berat');
		$harga = $this->input->post('harga');
		$total = $this->input->post('total');
		$data = array(

			'id_setor' => $id_setor,
			'id_sampah' => $jns_sampah,
			'berat' => $berat,
			'harga' => $harga,
			'total' => $total,
		);

		$this->m_setoran->input_detail($data, $id_setor);
		redirect('index.php/setoran/setoranindex');
	}

	public function hapus_setoran($id_setor)
	{
		$result = $this->m_setoran->hapus_setoran($id_setor);
		if ($result) {
			$this->session->set_flashdata('sukses', 'Data setoran berhasil dihapus');
			redirect('index.php/setoran/setoranindex');
		} else {
			$this->session->set_flashdata('gagal', 'Data setoran tidak dapat dihapus');
			redirect('index.php/setoran/setoranindex');
		}
	}
	public function hapus_detail_setoran()
	{
		$id_detail_setoran = $this->input->post('id_setor'); // Ambil ID detail setoran
		if ($this->m_setoran->hapus_detail($id_detail_setoran)) {
			echo json_encode(array('status' => 'success', 'message' => 'Data berhasil dihapus.'));
		} else {
			echo json_encode(array('status' => 'error', 'message' => 'Gagal menghapus data.'));
		}
	}
}
