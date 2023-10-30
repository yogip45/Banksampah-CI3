<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once __DIR__ . '/vendor/autoload.php';
require FCPATH . 'vendor/autoload.php';
class Cetaklaporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		cek_petugas();
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
		$data['title'] = "Dashboard - Cetak Laporan";
		$data['user'] = $this->m_petugas->get_petugas();
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar', $data);
		$this->load->view('admin/cetaklaporan', $data);
		$this->load->view('newtemplate/footer', $data);
	}
	public function create_laporan()
	{
		$this->form_validation->set_rules(
			'jns_transaksi',
			'Transaksi',
			'required|trim',
			array('required' => 'Pilih jenis transaksi')
		);
		$this->form_validation->set_rules(
			'tgl_awal',
			'Tanggal Awal',
			'required|trim',
			array('required' => 'Pilih tanggal')
		);
		$this->form_validation->set_rules(
			'tgl_akhir',
			'Tanggal Akhir',
			'required|trim',
			array('required' => 'Pilih tanggal')
		);
		if ($this->form_validation->run() == false) {
			$data['title'] = "Dashboard - Cetak Laporan";
			$data['user'] = $this->m_petugas->get_petugas();
			$this->load->view('newtemplate/header', $data);
			$this->load->view('newtemplate/top', $data);
			$this->load->view('newtemplate/sidebar', $data);
			$this->load->view('admin/cetaklaporan', $data);
			$this->load->view('newtemplate/footer', $data);
		} else {
			$tglAwal = $this->input->post('tgl_awal');
			$tglAkhir = $this->input->post('tgl_akhir');
			$jns = $this->input->post('jns_transaksi');
			$this->load->library('pdf');
			$data['tglAwal'] = date('d F Y', strtotime($tglAwal));
			$data['tglAkhir'] = date('d F Y', strtotime($tglAkhir));
			switch ($jns) {
				case 1:
					//setoran
					$data['setoran'] = $this->m_setoran->getSetoranByDateRange($tglAwal, $tglAkhir);
					$data['detail'] = $this->m_setoran->getDetailSetoranByDateRange($tglAwal, $tglAkhir);
					break;
				case 2:
					//penarikan
					$data['penarikan'] = $this->m_penarikan->getPenarikanByDateRange($tglAwal, $tglAkhir);
					break;
				case 3:
					//barangkeluar
					$data['barangkeluar'] = $this->m_setoran->getBarangKeluarByDateRange($tglAwal, $tglAkhir);
					break;
				default:
					$this->load->view('error/404');
					return;
			}
			$data['setoran'] = $data['setoran'] ?? null;
			$data['detail'] = $data['detail'] ?? null;
			$data['penarikan'] = $data['penarikan'] ?? null;
			$data['barangkeluar'] = $data['barangkeluar'] ?? null;
			$namaFile = '';
			if ($data['setoran'] != null) {
				$html = $this->load->view('transaksi/cetak1', $data, true);
				$namaFile = 'Laporan Setoran ' . $data['tglAwal'] . ' - ' . $data['tglAkhir'] . '.pdf';
			} elseif ($data['penarikan'] != null) {
				$html = $this->load->view('transaksi/cetak2', $data, true);
				$namaFile = 'Laporan Penarikan Saldo ' . $data['tglAwal'] . ' - ' . $data['tglAkhir'] . '.pdf';
			} elseif ($data['barangkeluar'] != null) {
				$html = $this->load->view('transaksi/cetak3', $data, true);
				$namaFile = 'Laporan Barang Keluar ' . $data['tglAwal'] . ' - ' . $data['tglAkhir'] . '.pdf';
			}
			if (!empty($namaFile)) {
				$mpdf = new \Mpdf\Mpdf();
				$mpdf->WriteHTML($html);
				$mpdf->Output($namaFile, 'D');
			}
		}
	}
}
