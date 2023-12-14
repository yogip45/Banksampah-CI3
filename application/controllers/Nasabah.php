<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nasabah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_login();
		cek_nasabah();
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
			if ($this->session->userdata('role') == 1) {
				$nin = $this->session->userdata('nin');
				$tahun = date('Y');
				$data['title'] = "Dashboard - Home Nasabah";
				$data['nasabah'] = $this->m_user->get_nasabah();
				$data['jumlah_setoran'] = $this->m_nasabah->totalKgSetoran($nin);
				$data['total_setoran'] = $this->m_nasabah->totalRpSetoran($nin);
				$data['total_penarikan'] = $this->m_nasabah->totalRpPenarikan($nin);
				//DATA CHART
				$data['jml_setoran'] = $this->m_nasabah->getSetoranByMonth($tahun, $nin);
				$data['jml_penarikan'] = $this->m_nasabah->getPenarikanByMonth($tahun, $nin);
				$this->load->view('usertemplate/header', $data);
				$this->load->view('usertemplate/top', $data);
				$this->load->view('usertemplate/sidebar', $data);
				$this->load->view('nasabah/dashboard', $data);
				$this->load->view('usertemplate/footer');
			} else {
				redirect('/index.php/auth/dashboard');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
	public function penarikan()
	{
		$nin = $this->session->userdata('nin');
		$data['title'] = "Dashboard - Ajukan Penarikan";
		$data['user'] = $this->m_user->get_user();
		$data['nasabah'] = $this->m_user->get_nasabah();
		$data['penarikan'] = $this->m_penarikan->tampil_databyNin($nin)->result();
		$this->load->view('usertemplate/header', $data);
		$this->load->view('usertemplate/top', $data);
		$this->load->view('usertemplate/sidebar', $data);
		$this->load->view('nasabah/penarikan', $data);
		$this->load->view('usertemplate/footer');
	}
	public function verify_penarikan()
	{
		$this->form_validation->set_rules(
			'nin',
			'Nin',
			'required|trim',
			array('required' => 'Nin Harus Diisi')
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
				$jumlah_penarikan = $this->input->post('jumlah_penarikan');
				$email = $this->session->userdata('email');

				$token = mt_rand(100000, 999999);
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];
				$this->db->insert('user_token', $user_token);
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


				$this->email->subject('Verifikasi Penarikan Saldo');

				$message = '<div style="text-align: left;">';
				$message .= '<h3>Hallo</h3>';
				$message .= '<div style="text-align: left;">';
				$message .= 'Terima Kasih, permintaan anda sedang diproses. Untuk melanjutkan, silakan gunakan kode ini untuk mengkonfirmasi penarikan saldo<br>';
				$message .= '<div style="text-align: left;">';
				$message .= '<h2>' . $token . '</h2>';
				$this->email->message($message);
				if ($this->email->send()) {
					$this->session->set_flashdata('sukses', 'Cek email anda untuk mendapatkan kode verifikasi');
					$redirect_url = site_url('/index.php/nasabah/cek_otp?nin=' . $nin . '&jumlah_penarikan=' . $jumlah_penarikan);
					redirect($redirect_url);
				} else {
					// $this->session->set_flashdata('gagal', 'Terjadi error');
					// redirect('index.php/nasabah/penarikan');
					echo $this->email->print_debugger();
				}
			} catch (Exception $e) {
				$this->session->set_flashdata('gagal', $e->getMessage());
			}
		} else {
			$nin = $this->session->userdata('nin');
			$data['title'] = "Dashboard - Ajukan Penarikan";
			$data['user'] = $this->m_user->get_user();
			$data['nasabah'] = $this->m_user->get_nasabah();
			$data['penarikan'] = $this->m_penarikan->tampil_databyNin($nin)->result();
			$this->load->view('usertemplate/header', $data);
			$this->load->view('usertemplate/top', $data);
			$this->load->view('usertemplate/sidebar', $data);
			$this->load->view('nasabah/penarikan', $data);
			$this->load->view('usertemplate/footer');
		}
	}
	public function cek_otp()
	{
		$data['title'] = "Dashboard - Ajukan Penarikan";
		$data['user'] = $this->m_user->get_user();
		$data['nasabah'] = $this->m_user->get_nasabah();
		$this->load->view('usertemplate/header', $data);
		$this->load->view('usertemplate/top', $data);
		$this->load->view('usertemplate/sidebar', $data);
		$this->load->view('nasabah/verify_penarikan', $data);
		$this->load->view('usertemplate/footer');
	}

	public function create_penarikan()
	{
		$nin = $this->input->post('nin');
		$token = $this->input->post('otp');
		$jumlah_penarikan = $this->input->post('jumlah_penarikan');
		$email = $this->session->userdata('email');
		$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
		if ($user_token) {
			if (time() - $user_token['date_created'] < 180) {
				$id_penarikan = getAutoNumber('tb_penarikan', 'id_penarikan', 'PN', '6');
				$success = true;
				$data = array(
					'id_penarikan' => $id_penarikan,
					'nin' => $nin,
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
				$this->db->delete('user_token', ['email' => $email]);
				$this->session->set_flashdata('sukses', 'Berhasil diproses, menunggu konfirmasi admin');
				redirect('/index.php/nasabah/penarikan');
			} else {
				$this->db->delete('user_token', ['email' => $email]);
				$this->session->set_flashdata('gagal', 'Kode kedaluarsa');
				redirect('/index.php/nasabah/penarikan');
			}
		} else {
			$this->session->set_flashdata('gagal', 'Kode tidak berlaku / salah');
			$redirect_url = site_url('/index.php/nasabah/cek_otp?nin=' . $nin . '&jumlah_penarikan=' . $jumlah_penarikan);
			redirect($redirect_url);
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
	public function setoran_saya()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role') == 1) {
				$nin = $this->session->userdata('nin');
				$data['title'] = "Dashboard - Setoran Saya";
				$data['nasabah'] = $this->m_user->get_nasabah();
				$data['setoran'] = $this->m_setoran->tampil_databyNin($nin)->result();
				$data['riwayat_transaksi'] = $this->m_setoran->get_keyword($nin);
				$data['penarikan'] = $this->m_penarikan->tampil_databyNin($nin)->result();
				$this->load->view('usertemplate/header', $data);
				$this->load->view('usertemplate/top', $data);
				$this->load->view('usertemplate/sidebar', $data);
				$this->load->view('nasabah/mytransaksi', $data);
				$this->load->view('usertemplate/footer', $data);
			} else {
				redirect('/index.php/auth/dashboard');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
	public function detail_setoran($id_setor)
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role') == 1) {
				// $id_setor = $this->input->post('id_setor');
				$data['title'] = "Dashboard - Detail Setoran Saya";
				$data['nasabah'] = $this->m_user->get_nasabah();
				$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
				$data['setoran'] = $this->m_setoran->get_nasabah($id_setor);
				$data['detail'] = $this->m_setoran->tampil_detail($id_setor)->result();
				$data['id_setor'] = $id_setor;
				$this->load->view('usertemplate/header', $data);
				$this->load->view('usertemplate/top', $data);
				$this->load->view('usertemplate/sidebar', $data);
				$this->load->view('nasabah/setorandetail', $data);
				$this->load->view('usertemplate/footer');
			} else {
				redirect('/index.php/auth/dashboard');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
}