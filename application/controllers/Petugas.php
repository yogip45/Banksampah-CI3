<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
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
		$this->load->model('m_alamat');
		$this->load->model('m_setoran');
		$this->load->model('m_penarikan');
		$this->load->model('m_stok');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function dashboard()
	{
		$data['title'] = "Dashboard - Home";
		$data['user'] = $this->m_petugas->get_petugas();
		$data['jumlah'] = $this->m_petugas->hitung();
		$data['tahun'] = $this->m_setoran->getTahun();
		$tahun = date('Y');
		$data['jml_setoran'] = $this->m_setoran->getSetoranByMonth($tahun);
		$data['jml_penarikan'] = $this->m_penarikan->getPenarikanByMonth($tahun);
		$data['jml_barangkeluar'] = $this->m_stok->getBarangKeluarByMonth($tahun);
		$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/footer', $data);
	}
	// FUNGSI UNTUK NASABAH
	public function nasabahindex()
	{
		$data['title'] = "Dashboard - Data Nasabah";
		$data['user'] = $this->m_user->get_user();
		$data['nasabah'] = $this->m_nasabah->tampil_data();
		foreach ($data['nasabah'] as $nasabah) {
			$nasabah->showHapusAkun = $this->m_nasabah->cek_hapus($nasabah);
		}
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar');
		$this->load->view('nasabah/nasabahindex', $data);
		$this->load->view('newtemplate/footer');
	}

	public function get_desa()
	{
		$id_kecamatan = $this->input->post('id_kecamatan');

		$getdatadesa = $this->m_alamat->getdatadesa($id_kecamatan);

		echo json_encode($getdatadesa);
	}
	public function get_desa_edit()
	{
		$id_kecamatan = $this->input->post('id_kecamatan');
		$id_desa = $this->input->post('id_desa');

		$getdatadesa = $this->m_alamat->getdatadesa($id_kecamatan);

		echo json_encode($getdatadesa);
	}
	public function tambah_nasabah()
	{
		$getdata = $this->m_alamat->getdatakecamatan();
		$data['alamat'] = $getdata;
		$data['title'] = "Dashboard - Form Tambah Nasabah";
		$data['user'] = $this->m_user->get_user();
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar', $data);
		$this->load->view('nasabah/nasabahtambah', $data);
		$this->load->view('newtemplate/footer');
	}
	public function create_nasabah()
	{
		$this->load->model('m_nasabah');
		$this->load->model('m_user');

		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'required|trim',
			array('required' => 'Nama Harus Diisi')
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email|is_unique[tb_user.email]',
			array('required' => 'Email Harus Diisi', 'valid_email' => 'Alamat Email Tidak Valid', 'is_unique' => 'Alamat Email Sudah Digunakan')
		);
		$this->form_validation->set_rules(
			'id_desa',
			'Desa',
			'required|trim',
			array('required' => 'Desa Harus Diisi')
		);
		$this->form_validation->set_rules(
			'id_kecamatan',
			'Kecamatan',
			'required|trim',
			array('required' => 'Kecamatan Harus Diisi')
		);
		$this->form_validation->set_rules(
			'alamat_lengkap',
			'Alamat_lengkap',
			'required|trim',
			array('required' => 'Alamat Harus Diisi')
		);
		$this->form_validation->set_rules(
			'rt',
			'Rt',
			'required|trim',
			array('required' => 'Rt Harus Diisi')
		);
		$this->form_validation->set_rules(
			'rw',
			'Rw',
			'required|trim',
			array('required' => 'Rw Harus Diisi')
		);
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'required|trim|min_length[8]',
			array(
				'required' => 'Password Harus Diisi',
				'min_length' => 'Minimal 8 karakter',
				'matches' => 'Password tidak cocok',
			)
		);
		if ($this->form_validation->run() == false) {
			$getdata = $this->m_alamat->getdatakecamatan();
			$data['alamat'] = $getdata;
			$data['title'] = "Dashboard - Form Tambah Nasabah";
			$data['user'] = $this->m_user->get_user();
			$this->load->view('newtemplate/header', $data);
			$this->load->view('newtemplate/top', $data);
			$this->load->view('newtemplate/sidebar', $data);
			$this->load->view('nasabah/nasabahtambah', $data);
			$this->load->view('newtemplate/footer');
		} else {
			$kodeunik = 'U' . uniqid();
			$nin = getAutoNin();
			$nama = $this->input->post('nama');
			$jk = $this->input->post('jk');
			$desa = $this->input->post('id_desa');
			$kecamatan = $this->input->post('id_kecamatan');
			$rt = $this->input->post('rt');
			$rw = $this->input->post('rw');
			$alamat_lengkap = $this->input->post('alamat_lengkap');
			$email = $this->input->post('email');
			$password = $this->input->post('password1');
			$pembuat = $this->m_petugas->get_petugas();
			$data = array(
				//auto generate nin
				'id_user' => $kodeunik,
				'username' => $nin,
				'role' => 1,
				'email' => $email,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'is_active' => 0,
				'foto' => 'default.jpg',
				'dibuat_oleh' => $pembuat['nama_petugas'],
				'default_password' => 1,
			);
			$token = base64_encode(random_bytes(16));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];
			$data1 = array(
				'id_user' => $kodeunik,
				'nin' => $nin,
				'nama' => $nama,
				'jk' => $jk,
				'id_desa' => $desa,
				'id_kecamatan' => $kecamatan,
				'rt' => $rt,
				'rw' => $rw,
				'alamat_lengkap' => $alamat_lengkap,
				'saldo' => 0,
			);

			$this->m_user->input_data($data, 'tb_user');
			$this->m_nasabah->input_data($data1, 'tb_nasabah');
			$this->db->insert('user_token', $user_token);
			$this->_sendEmail($token, 'verify', NULL);
			$this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
			redirect('/index.php/petugas/nasabahindex');
		}
	}
	private function _sendEmail($token, $type, $user)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'cikrakjatimulyo@gmail.com',
			'smtp_pass' => 'zckg gxbl znub wicu',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('cikrakjatimulyo@gmail.com', 'Tim Cikrak Jatimulyo');
		$this->email->to($this->input->post('email'));

		if ($type == 'verify') {

			$this->email->subject('Aktivasi Akun Banksampah');
			$message = '
			<div style="font-family: Arial, sans-serif; text-align: center; max-width: 600px; margin: 0 auto;">
				<div style="background-color: #f5f5f5; padding: 20px;">
					<h2>Hallo, ' . $this->input->post('nama') . '</h2>
				</div>
				<div style="margin: 20px;">
					<p>Terima kasih telah mendaftar di Bank Sampah. Untuk melanjutkan, silakan aktifkan akun Anda dengan mengeklik tombol di bawah ini:</p>
					<br>
					<a href="' . base_url() . 'index.php/auth/verify?email=' . urlencode($this->input->post('email')) . '&token=' . urlencode($token) . '" style="background-color:#4CAF50; color:white; padding:10px 20px; text-decoration:none; border-radius:5px; display:inline-block;">Aktifkan Akun</a>
					<br><br>
					<p>Jika tombol di atas tidak berfungsi, Anda juga dapat menyalin dan menempelkan tautan berikut ini ke peramban web Anda:</p>
					<p>' . base_url() . 'index.php/auth/verify?email=' . urlencode($this->input->post('email')) . '&token=' . urlencode($token) . '</p>
					<br>
					<p>Terima kasih, dan selamat bergabung dengan Bank Sampah Cikrak Jatimulyo.</p>
				</div>
			</div>';
			$this->email->message($message);
			if ($this->email->send()) {
				return true;
			} else {
				echo $this->email->print_debugger();
				die;
			}
		} elseif ($type == 'resetpassword') {
			$this->email->to($user);
			$this->email->subject('Reset Password Anda');
			$message = '<div style="text-align: center;">';
			$message .= 'Untuk meret password anda, klik tombol dibawah ini :<br><br>';
			$message .= '</div><br><br>';
			$message .= '<div style="text-align: center;">';
			$message .= '<a href="' . base_url() . 'index.php/auth/resetpassword?email=' . urlencode($user) . '&token=' . urlencode($token) . '" style="background-color:#4CAF50; color:white; padding:10px 20px; text-decoration:none; border-radius:5px; display:inline-block;">Reset Password</a>';
			$message .= '</div><br><br>';
			$message .= '<div style="text-align: center;">';
			$message .= 'Jika tombol di atas tidak berfungsi, Anda juga dapat menggunakan link dibawah ini :<br><br>';
			$message .= '</div><br><br>';
			$message .= '<div style="text-align: center;">';
			$message .= base_url() . 'index.php/auth/resetpassword?email=' . urlencode($user) . '&token=' . urlencode($token);
			$this->email->message($message);
			if ($this->email->send()) {
				return true;
			} else {
				echo $this->email->print_debugger();
				die;
			}
		} elseif ($type == 'disable') {
			$this->email->to($user);
			$this->email->subject('Akun Anda Dinonaktifkan');
			$message = '<div style="font-family: Arial, sans-serif;">
							<div style="text-align: center; background-color: #f5f5f5; padding: 20px;">
								<h2>Notifikasi Akun Dinonaktifkan</h2>
							</div>
							<div style="margin: 20px;">
								<p>Hallo,</p>
								<p>Kami ingin memberitahu Anda bahwa akun Anda telah dinonaktifkan.</p>
								<p>Silahkan hubungi petugas layanan pelanggan kami untuk informasi lebih lanjut.</p>
							</div>
							<div style="text-align: center; background-color: #f5f5f5; padding: 10px;">
								<p>Terima Kasih,</p>
								<p>Tim Layanan Pelanggan Bank Sampah</p>
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

	public function edit_nasabah($id_user)
	{
		$data['title'] = "Dashboard - Edit Nasabah";
		$data['user'] = $this->m_user->get_user();
		$this->load->model('m_nasabah');
		$this->load->model('m_user');
		$data['kecamatan'] = $this->m_alamat->getdatakecamatan();
		$data['nasabah'] = $this->m_nasabah->get_user_nasabah_data($id_user);
		$this->load->view('newtemplate/header', $data);
		$this->load->view('newtemplate/top', $data);
		$this->load->view('newtemplate/sidebar', $data);
		$this->load->view('nasabah/nasabahedit', $data);
		$this->load->view('newtemplate/footer', $data);
	}
	public function update_nasabah()
	{
		$this->load->model('m_nasabah');
		$this->load->model('m_user');

		$nama = $this->input->post('nama');
		$id_user = $this->input->post('id_user');
		$rt = $this->input->post('rt');
		$rw = $this->input->post('rw');
		$jk = $this->input->post('jk');
		$desa = $this->input->post('id_desa');
		$kecamatan = $this->input->post('id_kecamatan');
		$alamat_lengkap = $this->input->post('alamat_lengkap');

		$data = array(
			'diedit' => date('Y-m-d H:i:s'),
		);
		$data1 = array(
			'nama' => $nama,
			'rt' => $rt,
			'rw' => $rw,
			'id_desa' => $desa,
			'id_kecamatan' => $kecamatan,
			'alamat_lengkap' => $alamat_lengkap,
			'jk' => $jk,
		);

		$where = array(
			'id_user' => $id_user
		);

		$this->m_user->update_data($where, $data, 'tb_user');
		$this->m_nasabah->update_data($where, $data1, 'tb_nasabah');
		$this->session->set_flashdata('edit', 'Data Berhasil Diubah!');
		redirect('/index.php/petugas/nasabahindex');
	}
	public function ubahstatus_nasabah($id_user)
	{
		$this->load->model('m_user');
		$where = array('id_user' => $id_user);
		$table = 'tb_user';

		// Ambil data user berdasarkan ID
		$user = $this->m_user->get_user_by_id($id_user);
		if ($user && isset($user['is_active'])) {
			if ($user['is_active'] == 1) {
				$this->_sendEmail(NULL, 'disable', $user['email']);
				$data = array('is_active' => 0, 'diedit' => date('Y-m-d H:i:s'));
			} else {
				$data = array('is_active' => 1, 'diedit' => date('Y-m-d H:i:s'));
			}

			$this->m_user->change_status($where, $data, $table);
			$this->session->set_flashdata('sukses', 'Status Akun Berhasil diubah');
		} else {
			$this->session->set_flashdata('hapus', 'Akun tidak ditemukan');
		}
		redirect('/index.php/petugas/nasabahindex');
	}
	public function resetpassword_nasabah($id_user)
	{
		$this->load->model('m_user');
		$this->load->model('m_nasabah');
		$nasabah = $this->m_nasabah->get_user_nasabah_data($id_user);
		$email = $nasabah[0]->email;
		if ($email) {
			$token = base64_encode(random_bytes(16));
			$user_token = [
				'email' => $email,
				'token' => $token,
				'date_created' => time()
			];
			$this->db->insert('user_token', $user_token);
			$this->_sendEmail($token, 'resetpassword', $email);
			$this->session->set_flashdata('sukses', 'Email reset pasword berhasil dikirimkan ke ' . $email);
			redirect('/index.php/petugas/nasabahindex');
		} else {
			$this->session->set_flashdata('gagal', 'Terjadi Kesalahan');
			redirect('/index.php/petugas/nasabahindex');
		}
	}


	// public function resetpassword_nasabah($id_user)
	// {
	// 	$this->load->model('m_user');
	// 	$this->load->model('m_nasabah');
	// 	$default_password = generate_password(10);
	// 	$nasabah = $this->m_nasabah->get_user_nasabah_data($id_user);
	// 	$where = array('id_user' => $id_user);
	// 	$table = 'tb_user';
	// 	// Hash default password							
	// 	// Update password dalam tabel
	// 	$data = array(
	// 		'password' => password_hash($default_password, PASSWORD_DEFAULT),
	// 		'default_password' => 1, // Mengatur default_password menjadi 1
	// 		'diedit' => date('Y-m-d H:i:s')
	// 	);
	// 	$this->m_user->reset_password($where, $data, $table);
	// 	$this->session->set_flashdata('sukses', 'Password berhasil direset');
	// 	$this->session->set_flashdata('password', $default_password);
	// 	$this->session->set_flashdata('nasabah', $nasabah['nama']);
	// 	redirect('/index.php/petugas/nasabahindex');
	// }

}
