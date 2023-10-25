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
					$data['penarikan'] = NULL;
					$data['barangkeluar'] = NULL;
					$html = $this->load->view('transaksi/cetak', $data, true);
					// echo $html;
					$mpdf = new \Mpdf\Mpdf();
					$mpdf->debug = true;
					$mpdf->WriteHTML($html);
					$mpdf->Output();
					break;
				case 2:
					//penarikan
					$data['penarikan'] = $this->m_penarikan->getPenarikanByDateRange($tglAwal, $tglAkhir);
					$data['setoran'] = NULL;
					$data['detail'] = NULL;
					$data['barangkeluar'] = NULL;
					$html = $this->load->view('transaksi/cetak', $data, true);
					$this->pdf->createPDF($html, "Laporan Penarikan Saldo " . $data['tglAwal'] . " - " . $data['tglAkhir'] . ".pdf");
					break;
				case 3:
					//barangkeluar
					$data['barangkeluar'] = $this->m_setoran->getBarangKeluarByDateRange($tglAwal, $tglAkhir);
					$data['setoran'] = NULL;
					$data['penarikan'] = NULL;
					$data['detail'] = NULL;
					$html = $this->load->view('transaksi/cetak', $data, true);
					$this->pdf->createPDF($html, "Laporan Barang Keluar " . $data['tglAwal'] . " - " . $data['tglAkhir'] . ".pdf");
					break;
				default:
					$this->load->view('error/404');
					break;
			}
		}
	}
}
