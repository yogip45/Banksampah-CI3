<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penarikan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		cek_login();
		cek_petugas();
		$this->load->library('session');
		$this->load->model('m_nasabah');
		$this->load->model('m_petugas');
		$this->load->model('m_user');
		$this->load->model('m_jns_sampah');
		$this->load->model('m_setoran');
		$this->load->model('m_stok');
		$this->load->model('m_penarikan');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function penarikanindex()
	{
		$data['title'] = "Dashboard - Data Penarikan";
		$data['user'] = $this->m_user->get_user();
		$data['nasabah'] = $this->m_nasabah->tampil_data();
		$data['penarikan'] = $this->m_penarikan->tampil_data()->result();
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar', $data);
		$this->load->view('transaksi/penarikanindex', $data);
		$this->load->view('newtemplate/footer');
	}
	public function getdata_nasabah()
	{
		$nin = $this->input->post('nin');
		$data_nasabah = $this->m_penarikan->getdata_nasabah($nin);
		echo json_encode($data_nasabah);
	}
	public function create_penarikan()
	{
		$this->form_validation->set_rules(
			'nin',
			'Nin',
			'required|trim',
			array('required' => 'Nin Harus Diisi')
		);
		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'required|trim',
			array('required' => 'Nama Harus Diisi')
		);
		$this->form_validation->set_rules(
			'saldo',
			'Saldo',
			'required|trim',
			array('required' => 'Saldo Harus Diisi')
		);
		$nin = $this->input->post('nin');
		$this->form_validation->set_rules(
			'jumlah_penarikan',
			'Jumlah',
			'required|trim|callback_compare_with_saldo[' . $nin . ']',
			array('required' => 'Masukan nominal penarikan')
		);
		if ($this->form_validation->run() == true) {
			try {
				$id_penarikan = getAutoNumber('tb_penarikan', 'id_penarikan', 'PN', '6');
				$nin = $this->input->post('nin');
				$saldo = $this->input->post('saldo');
				$jumlah_penarikan = $this->input->post('jumlah_penarikan');
				$success = true;
				$data = array(
					'id_penarikan' => $id_penarikan,
					'nin' => $nin,
					'saldo' => $saldo,
					'jumlah_penarikan' => $jumlah_penarikan,
					'status' => 0,
					'id_petugas' => $this->session->userdata('id_user'),
				);
				$success = $this->m_penarikan->input_penarikan($data) && $this->m_penarikan->ambil_saldo($jumlah_penarikan, $nin);
				if ($success) {
					$this->session->set_flashdata('sukses', 'Berhasil Ditambahkan');
				} else {
					throw new Exception('Gagal menambahkan data.');
				}
			} catch (Exception $e) {
				$this->session->set_flashdata('gagal', $e->getMessage());
			}
			redirect('index.php/penarikan/penarikanindex');
		} else {
			$data['title'] = "Dashboard - Data Penarikan";
			$data['user'] = $this->m_user->get_user();
			$data['nasabah'] = $this->m_nasabah->tampil_data();
			$data['penarikan'] = $this->m_penarikan->tampil_data()->result();
			$this->load->view('newtemplate/header', $data);
			$this->load->view('newtemplate/top', $data);
			$this->load->view('newtemplate/sidebar', $data);
			$this->load->view('transaksi/penarikanindex', $data);
			$this->load->view('newtemplate/footer');
		}
	}

	public function compare_with_saldo($input, $nin)
	{
		if ($nin != NULL) {
			$this->load->model('m_penarikan');
			$saldo_value = $this->m_penarikan->get_saldo($nin);
			if ((int)$input > $saldo_value['saldo']) {
				$this->form_validation->set_message('compare_with_saldo', 'Saldo Tidak Mencukupi');
				return false;
			} else {
				return true;
			}
		}
	}
	public function konfirmasi($id_penarikan, $nin)
	{
		$email = $this->m_nasabah->get_email($nin);
		$jumlah_penarikan = $this->m_penarikan->get_jumlah_penarikan($id_penarikan);
		if ($this->m_penarikan->konfirmasiPenarikan($id_penarikan)) {
			$this->_sendReceipt('konfirmasi', $id_penarikan, $jumlah_penarikan, $email);
			$this->session->set_flashdata('sukses', 'Bukti transaksi sudah dikirimkan ke email nasabah');
		} else {
			$this->session->set_flashdata('gagal', 'Terjadi kesalahan');
		}
		redirect('/index.php/penarikan/penarikanindex');
	}
	private function _sendReceipt($type, $id_penarikan, $jumlah_penarikan, $email)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'cikrakjatimulyo@gmail.com',
			'smtp_pass' => 'nypk qrne gwca exnu',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];
		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('cikrakjatimulyo@gmail.com', 'Tim Cikrak Jatimulyo');
		$this->email->to($email);

		if ($type == 'konfirmasi') {

			$this->email->subject('Transaksi Penarikan Selesai');
			$date = date('Y-m-d H:i');
			$timestamp = strtotime($date);
			$tanggal = date('d F Y H:i', $timestamp);
			$message = '
			<div style="font-family: Arial, sans-serif;">
				<div style="text-align: center; background-color: #f5f5f5; padding: 20px;">
					<h2>Notifikasi Penarikan Saldo Berhasil</h2>
				</div>
				<div style="margin: 20px;">
					<p>Hallo,</p>
					<p>Terima kasih, penarikan saldo Anda berhasil diproses.</p>
					<p>Berikut adalah detail penarikan anda :</p>
					<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
						<tr style="background-color: #f5f5f5;">
							<th style="padding: 10px; text-align: left;">Nomor Transaksi</th>
							<td style="padding: 10px; text-align: left;">' . $id_penarikan . ' </td>
						</tr>
						<tr>
							<th style="padding: 10px; text-align: left;">Tanggal</th>
							<td style="padding: 10px; text-align: left;">' . $tanggal . '</td>
						</tr>
						<tr style="background-color: #f5f5f5;">
							<th style="padding: 10px; text-align: left;">Jumlah Penarikan</th>
							<td style="padding: 10px; text-align: left;">Rp. ' . $jumlah_penarikan . '</td>
						</tr>
						<!-- Tambahkan detail lainnya sesuai kebutuhan -->
					</table>
					<p>Terima kasih atas kepercayaan Anda kepada kami.</p>
				</div>
				<div style="text-align: center; background-color: #f5f5f5; padding: 10px;">
					<p>Terima Kasih,</p>
					<p>Tim Layanan Pelanggan</p>
				</div>
			</div>';
			$this->email->message($message);
			if ($this->email->send()) {
				return true;
			} else {
				echo $this->email->print_debugger();
				die;
			}
		}
	}
	public function batalkan($id_penarikan)
	{
		$data_penarikan = $this->db->where('id_penarikan', $id_penarikan)->get('tb_penarikan')->row();
		$nin = $data_penarikan->nin;
		$jumlah_penarikan = $data_penarikan->jumlah_penarikan;

		if ($this->m_penarikan->batalkanPenarikan($nin, $jumlah_penarikan, $id_penarikan)) {
			$this->session->set_flashdata('sukses', 'Pembatalan berhasil.');
		} else {
			$this->session->set_flashdata('gagal', 'Terjadi error.');
		}

		$this->session->set_flashdata('sukses', 'Pembatalan berhasil.');

		redirect('/index.php/penarikan/penarikanindex');
	}
}
