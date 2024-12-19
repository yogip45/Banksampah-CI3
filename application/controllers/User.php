<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('m_nasabah');
		$this->load->model('m_petugas');
		$this->load->model('m_user');

		// $this->data['title'] = 'Dashboard - Data Nasabah';
		$this->data['petugas'] = $this->m_petugas->tampil_data()->result();
	}

	public function index() {}

	public function myprofile()
	{
		if ($this->session->userdata('email')) {
			$role = $this->session->userdata('role');
			$data['title'] = 'Dashboard - Profile Saya';

			switch ($role) {
				case 1:
					$this->load->model('m_user');
					$data['nasabah'] = $this->m_user->get_nasabah();
					$this->load->view('usertemplate/header', $data);
					$this->load->view('usertemplate/top', $data);
					$this->load->view('usertemplate/sidebar', $data);
					$this->load->view('nasabah/myprofile', $data);
					$this->load->view('usertemplate/footer');
					break;
				case 2:
					$data['user'] = $this->m_user->get_user();
					$this->load->view('newtemplate/header', $data);
					$this->load->view('newtemplate/top', $data);
					$this->load->view('newtemplate/sidebar');
					$this->load->view('user/myprofile', $data);
					$this->load->view('newtemplate/footer');
					break;
				case 3:
					$data['user'] = $this->m_user->get_user();
					$this->load->view('newtemplate/header', $data);
					$this->load->view('newtemplate/top', $data);
					$this->load->view('newtemplate/sidebar');
					$this->load->view('user/myprofile', $data);
					$this->load->view('newtemplate/footer');
					break;
				default:
					$this->load->view('error/404');
					break;
			}
		} else {
			redirect('index.php/auth');
		}
	}

	public function passwordmake()
	{
		if ($this->session->userdata('email')) {

			$this->form_validation->set_rules(
				'password1',
				'Password',
				'required|trim|min_length[8]|matches[password2]',
				array(
					'required' => 'Password Harus Diisi',
					'min_length' => 'Minimal 8 karakter',
					'matches' => 'Password tidak cocok',
				)
			);
			$this->form_validation->set_rules(
				'password2',
				'Confirm Password',
				'required|trim|matches[password1]',
				array(
					'required' => 'Password Harus Diisi',
					'matches' => 'Password tidak cocok',
				)
			);
			if ($this->form_validation->run() == false) {
				$data['title'] = 'Dashboard - Ganti Password';
				$data['user'] = $this->m_user->get_user();
				$this->load->view('usertemplate/header', $data);
				$this->load->view('ubahpassword/top', $data);
				$this->load->view('ubahpassword/sidebar');
				$this->load->view('ubahpassword/index');
			} else {
				$password = $this->input->post('password1');
				$password_hash = password_hash($password, PASSWORD_DEFAULT);
				$this->db->set('password', $password_hash);
				$this->db->where('email', $this->session->userdata('email'));
				$this->db->update('tb_user');
				$this->db->set('default_password', 0);
				$this->db->where('email', $this->session->userdata('email'));
				$this->db->update('tb_user');
				$this->session->set_flashdata('sukses', 'Password berhasil diubah');
				redirect('/index.php/user/myprofile');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
	public function passwordreset()
	{
		if ($this->session->userdata('reset_email')) {
			$this->form_validation->set_rules(
				'password1',
				'Password',
				'required|trim|min_length[8]|matches[password2]',
				array(
					'required' => 'Password Harus Diisi',
					'min_length' => 'Minimal 8 karakter',
					'matches' => 'Password tidak cocok',
				)
			);
			$this->form_validation->set_rules(
				'password2',
				'Confirm Password',
				'required|trim|matches[password1]',
				array(
					'required' => 'Password Harus Diisi',
					'matches' => 'Password tidak cocok',
				)
			);
			if ($this->form_validation->run() == false) {
				$data['title'] = 'Dashboard - Ganti Password';
				$data['user'] = $this->m_user->get_user();
				$this->load->view('usertemplate/header', $data);
				$this->load->view('ubahpassword/top', $data);
				$this->load->view('ubahpassword/sidebar');
				$this->load->view('ubahpassword/reset');
			} else {
				$password = $this->input->post('password1');
				$password_hash = password_hash($password, PASSWORD_DEFAULT);
				$this->db->set('password', $password_hash);
				$email = $this->session->userdata('reset_email');
				$this->db->where('email', $email);
				$this->db->update('tb_user');
				$this->db->set('default_password', 0);
				$this->db->where('email', $this->session->userdata('email'));
				$this->db->update('tb_user');
				$this->session->unset_userdata('reset_email');
				$this->session->set_flashdata('sukses', 'Password berhasil diubah');
				redirect('/index.php/auth');
			}
		} else {
			redirect('/index.php/auth');
		}
	}

	public function update_password()
	{
		$data['title'] = 'Dashboard - Profile Saya';
		$data['user'] = $this->m_user->get_user();
		$this->form_validation->set_rules(
			'passwordold',
			'Old Password',
			'required|trim',
			array(
				'required' => 'Password Harus Diisi',
			)
		);
		$this->form_validation->set_rules(
			'password1',
			'Password',
			'required|trim|min_length[8]|matches[password2]',
			array(
				'required' => 'Password Harus Diisi',
				'min_length' => 'Minimal 8 karakter',
				'matches' => 'Password tidak cocok',
			)
		);
		$this->form_validation->set_rules(
			'password2',
			'Confirm Password',
			'required|trim|matches[password1]',
			array(
				'required' => 'Password Harus Diisi',
				'matches' => 'Password tidak cocok',
			)
		);
		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/top', $data);
			$this->load->view('template/sidebar');
			$this->load->view('user/myprofile', $data);
		} else {
			$password = $this->input->post('password1');
			$current_password = $this->input->post('passwordold');
			$password_field = ($this->session->userdata('role') == 1) ? 'nasabah' : 'user';

			if (!password_verify($current_password, $this->data[$password_field]['password'])) {
				$this->session->set_flashdata('error', 'Password tidak cocok dengan password lama');
			} else {
				$password_hash = password_hash($password, PASSWORD_DEFAULT);
				$this->db->set('password', $password_hash);
				$this->db->where('email', $this->session->userdata('email'));
				$this->db->update('tb_user');
				$this->session->set_flashdata('sukses', 'Password berhasil diubah');
			}
			redirect('/index.php/user/myprofile');
		}
	}

	public function update_profile()
	{
		$data['title'] = 'Dashboard - Profile Saya';
		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'required|trim',
			array('required' => 'Nama Harus Diisi')
		);
		$this->form_validation->set_rules(
			'username',
			'Username',
			'required|trim|is_unique[tb_user.username]',
			array('required' => 'Username Harus Diisi', 'is_unique' => 'Username Sudah Digunakan')
		);
		if ($this->form_validation->run() == false) {
			$data['user'] = $this->m_user->get_user();
			$role = $this->session->userdata('role');
			$data['title'] = 'Dashboard - Profile Saya';

			switch ($role) {
				case 1:
					$this->load->model('m_user');
					$data['nasabah'] = $this->m_user->get_nasabah();
					$this->load->view('usertemplate/header', $data);
					$this->load->view('usertemplate/top', $data);
					$this->load->view('usertemplate/sidebar', $data);
					$this->load->view('nasabah/myprofile', $data);
					$this->load->view('usertemplate/footer');
					break;
				case 2:
					$data['user'] = $this->m_user->get_user();
					$this->load->view('newtemplate/header', $data);
					$this->load->view('newtemplate/top', $data);
					$this->load->view('newtemplate/sidebar');
					$this->load->view('user/myprofile', $data);
					$this->load->view('newtemplate/footer');
					break;
				case 3:
					$data['user'] = $this->m_user->get_user();
					$this->load->view('newtemplate/header', $data);
					$this->load->view('newtemplate/top', $data);
					$this->load->view('newtemplate/sidebar');
					$this->load->view('user/myprofile', $data);
					$this->load->view('newtemplate/footer');
					break;
				default:
					$this->load->view('error/404');
					break;
			}
		} else {
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat_lengkap');
			$no_hp = $this->input->post('no_hp');
			$username = $this->input->post('username');
			$id_user = $this->input->post('id_user');
			if ($this->session->userdata('role') == 1) {
				//JIKA USER NASABAH
				$data = array(
					'nama' => $nama,
					'alamat_lengkap' => $alamat,
				);
				$data1 = array(
					'diedit' => date('Y-m-d H:i:s'),
					'username' => $username,
				);
				$where = array(
					'id_user' => $id_user,
				);
				$this->m_petugas->update_data($where, $data, 'tb_nasabah');
				$this->m_user->update_data($where, $data1, 'tb_user');
				$this->session->set_flashdata('sukses', 'Data Diri Berhasil Diubah');
				redirect('/index.php/user/myprofile');
			} else {
				// JIKA USER ADMIN / PETUGAS
				$data1 = array(
					'nama_petugas' => $nama,
					'no_hp' => $no_hp,
					'diedit' => date('Y-m-d H:i:s'),
					'username' => $username,
				);
				$where = array(
					'id_user' => $id_user,
				);
				$this->m_petugas->update_data($where, $data1, 'tb_user');
				$this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
				redirect('/index.php/user/myprofile');
			}
		}
	}
	public function updatefoto()
	{

		$this->load->model('m_petugas');
		$this->load->model('m_user');

		$foto = $_FILES['foto'];
		$id_user = $this->input->post('id_user');
		$config['upload_path'] = './assets/foto';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('foto')) {
			$this->session->set_flashdata('error', 'Tidak ada gambar yang di pilih / gambar terlalu besar Max 2Mb');
			redirect('index.php/user/myprofile');
		} else {
			$foto = $this->upload->data('file_name');
		}

		$data = array(
			'id_user' => $id_user,
			'foto' => $foto,
			'diedit' => date('Y-m-d H:i:s'),
		);
		$where = array(
			'id_user' => $id_user
		);

		$this->m_user->update_data($where, $data, 'tb_user');
		$this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
		redirect('/index.php/user/myprofile');
	}

	public function form_tambah()
	{
		$this->load->view('template/header');
		$this->load->view('template/top');
		$this->load->view('template/sidebar');
		$this->load->view('admin/usertambah');
	}

	public function hapus($id_petugas)
	{
		$this->load->model('m_petugas');

		$where = array('id_petugas' => $id_petugas);
		$this->m_petugas->hapus_data($where, 'tb_petugas');
		$this->session->set_flashdata('hapus', 'Data Berhasil Dihapus');
		redirect('/petugas/index');
	}
	public function ubahstatus($id_user)
	{
		$this->load->model('m_user');

		$where = array('id_user' => $id_user);
		$table = 'tb_user';

		// Ambil data user berdasarkan ID
		$user = $this->m_user->get_user_by_id($id_user);

		if ($user && isset($user['is_active'])) {
			if ($user['is_active'] == 1) {
				$data = array('is_active' => 0, 'diedit' => date('Y-m-d H:i:s'));
			} else {
				$data = array('is_active' => 1, 'diedit' => date('Y-m-d H:i:s'));
			}

			$this->m_user->change_status($where, $data, $table);
			$this->session->set_flashdata('sukses', 'Status Akun Berhasil diubah');
		} else {
			$this->session->set_flashdata('hapus', 'Akun tidak ditemukan');
		}
		redirect('/index.php/petugas/index');
	}
	public function resetpassword($id_user)
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3) {
				$this->load->model('m_user');
				$default_password = 'password';
				$where = array('id_user' => $id_user);
				$table = 'tb_user';
				// Hash default password							
				// Update password dalam tabel
				$data = array(
					'password' => password_hash($default_password, PASSWORD_DEFAULT),
					'default_password' => 1, // Mengatur default_password menjadi 1
					'diedit' => date('Y-m-d H:i:s')
				);
				$this->m_user->reset_password($where, $data, $table);
				$this->session->set_flashdata('sukses', 'Password berhasil direset');
				redirect('/index.php/petugas/index');
			} else {
				$this->load->view('error/403');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
	public function resetpasswordnasabah($id_user)
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3) {
				$this->load->model('m_user');
				$default_password = 'password@_';
				$where = array('id_user' => $id_user);
				$table = 'tb_user';
				// Hash default password							
				// Update password dalam tabel
				$data = array(
					'password' => password_hash($default_password, PASSWORD_DEFAULT),
					'default_password' => 1, // Mengatur default_password menjadi 1
					'diedit' => date('Y-m-d H:i:s')
				);
				$this->m_user->reset_password($where, $data, $table);
				$this->session->set_flashdata('sukses', 'Password berhasil direset');
				redirect('/index.php/nasabah/index');
			} else {
				$this->load->view('error/403');
			}
		} else {
			redirect('/index.php/auth');
		}
	}
	public function ubahstatus1($id_user)
	{
		$this->load->model('m_user');

		$where = array('id_user' => $id_user);
		$table = 'tb_user';

		// Ambil data user berdasarkan ID
		$user = $this->m_user->get_user_by_id($id_user);

		if ($user && isset($user['is_active'])) {
			if ($user['is_active'] == 1) {
				$data = array('is_active' => 0, 'diedit' => date('Y-m-d H:i:s'));
			} else {
				$data = array('is_active' => 1, 'diedit' => date('Y-m-d H:i:s'));
			}

			$this->m_user->change_status($where, $data, $table);
			$this->session->set_flashdata('sukses', 'Status Akun Berhasil diubah');
		} else {
			$this->session->set_flashdata('hapus', 'Akun tidak ditemukan');
		}
		redirect('/index.php/nasabah/index');
	}
}
