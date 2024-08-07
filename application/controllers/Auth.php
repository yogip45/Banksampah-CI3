<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->data['title'] = 'Dashboard - Home';
		$this->load->model('m_petugas');
		$this->load->model('m_user');
	}
	public function index()
	{
		$data = array(
			'widget' => $this->recaptcha->getWidget(),
			'script' => $this->recaptcha->getScriptTag(),
		);
		//jika sudah login
		if ($this->session->userdata('email')) {
			$role = $this->session->userdata('role');
			switch ($role) {
				case 1:
					redirect('index.php/nasabah/dashboard');
					break;
				case 2:
					redirect('index.php/petugas/dashboard');
					break;
				case 3:
					redirect('index.php/admin/dashboard');
					break;
				default:
					$this->load->view('error/404');
					break;
			}
		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == false) {
				$this->load->view('auth/login', $data);
			} else {
				//validasi berhasil
				if ($this->session->userdata('login_attempts') >= 3) {
					$this->load->library('recaptcha');
					$recaptcha = $this->input->post('g-recaptcha-response');
					if (!empty($recaptcha)) {
						$response = $this->recaptcha->verifyResponse($recaptcha);
						if (isset($response['success']) && $response['success'] === true) {
							// reCaptcha valid, lanjutkan dengan proses login
							$this->_login();
						} else {
							// reCaptcha tidak valid
							$this->session->set_flashdata('recaptcha_error', 'Verifikasi Captcha Gagal, Coba Lagi');
							redirect('index.php/auth');
						}
					} else {
						// reCaptcha tidak diisi
						$this->session->set_flashdata('recaptcha_error', 'Selesaikan Captcha Terlebih Dahulu');
						redirect('index.php/auth');
					}
				} else {
					$this->_login();
				}
			}
		}
	}

	// public function changepassword()
	// {
	// 	if ($this->session->userdata('email')) {
	// 		$data['title'] = "Dashboard - Ganti Password";
	// 		$data['user'] = $this->m_user->get_user();
	// 		$this->load->view('usertemplate/header', $data);
	// 		$this->load->view('ubahpassword/top', $data);
	// 		$this->load->view('ubahpassword/sidebar');
	// 		$this->load->view('ubahpassword/index');
	// 		$this->load->view('newtemplate/footer');
	// 	} else {
	// 		redirect('index.php/auth');
	// 	}
	// }

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('login_attempts');
		$this->session->unset_userdata('default_password');
		$this->session->set_flashdata('sukses', 'Berhasil Logout');
		redirect('/index.php/auth');
	}
	private function _login()
	{
		// $this->ClearCaptcha();
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();
		$username = $this->db->get_where('tb_user', ['username' => $email])->row_array();
		$login_attempts = $this->session->userdata('login_attempts');
		if ($user) {
			//emailnya ada and aktif
			if ($user['is_active'] == 1) {
				//cek passwd
				if (password_verify($password, $user['password'])) {
					$this->session->set_userdata('login_attempts', 0);
					$data = [
						'email' => $user['email'],
						'role' => $user['role'],
						'username' => $user['username'],
						'id_user' => $user['id_user'],
						'default_password' => $user['default_password'],
					];
					$this->db->set('last_login', 'NOW()', FALSE);
					$this->db->where('email', $user['email']);
					$this->db->update('tb_user');
					$this->session->set_userdata($data);
					if ($user['role'] == 3) {
						if ($this->session->userdata('default_password') == 0) {
							redirect('/index.php/admin/dashboard');
						} else {
							redirect('/index.php/auth/makepassword');
						}
					} elseif ($user['role'] == 2) {
						if ($this->session->userdata('default_password') == 0) {
							redirect('/index.php/petugas/dashboard');
						} else {
							redirect('/index.php/auth/makepassword');
						}
					} elseif ($user['role'] == 1) {
						if ($this->session->userdata('default_password') == 0) {
							$nasabah = $this->db->get_where('tb_nasabah', ['id_user' => $user['id_user']])->row_array();
							$data1 = $nasabah['nin'];
							$this->session->set_userdata('nin', $data1);
							redirect('/index.php/nasabah/dashboard');
						} else {
							$nasabah = $this->db->get_where('tb_nasabah', ['id_user' => $user['id_user']])->row_array();
							$data1 = $nasabah['nin'];
							$this->session->set_userdata('nin', $data1);
							redirect('/index.php/auth/makepassword');
						}
					}
				} else {
					$this->session->set_flashdata('message', 'Password Salah');
					// $this->load->view('auth/login');
					$login_attempts = ($login_attempts) ? $login_attempts + 1 : 1;
					$this->session->set_userdata('login_attempts', $login_attempts);
					redirect('/index.php/auth');
				}
			} else {
				$this->session->set_flashdata('message', 'Email / Username tidak aktif, silahkan cek email anda');
				$login_attempts = ($login_attempts) ? $login_attempts + 1 : 1;
				$this->session->set_userdata('login_attempts', $login_attempts);
				redirect('/index.php/auth');
			}
		}
		//JIKA LOGIN PAKAI USERNAME
		elseif ($username) {
			if ($username['is_active'] == 1) {
				//cek passwd
				if (password_verify($password, $username['password'])) {
					$this->session->set_userdata('login_attempts', 0);
					$data = [
						'email' => $username['email'],
						'role' => $username['role'],
						'username' => $username['username'],
						'id_user' => $username['id_user'],
						'default_password' => $username['default_password'],
					];
					$this->db->set('last_login', 'NOW()', FALSE);
					$this->db->where('email', $username['email']);
					$this->db->update('tb_user');
					$this->session->set_userdata($data);

					if ($username['role'] == 3) {
						if ($this->session->userdata('default_password') == 0) {
							redirect('/index.php/admin/dashboard');
						} else {
							redirect('/index.php/auth/makepassword');
						}
					} elseif ($username['role'] == 2) {
						if ($this->session->userdata('default_password') == 0) {
							redirect('/index.php/petugas/dashboard');
						} else {
							redirect('/index.php/auth/makepassword');
						}
					} elseif ($username['role'] == 1) {
						if ($this->session->userdata('default_password') == 0) {
							$nasabah = $this->db->get_where('tb_nasabah', ['id_user' => $user['id_user']])->row_array();
							$data1 = $nasabah['nin'];
							$this->session->set_userdata('nin', $data1);
							redirect('/index.php/nasabah/dashboard');
						} else {
							$nasabah = $this->db->get_where('tb_nasabah', ['id_user' => $user['id_user']])->row_array();
							$data1 = $nasabah['nin'];
							$this->session->set_userdata('nin', $data1);
							redirect('/index.php/auth/makepassword');
						}
					}
				} else {
					$this->session->set_flashdata('message', 'Password Salah');
					$login_attempts = ($login_attempts) ? $login_attempts + 1 : 1;
					$this->session->set_userdata('login_attempts', $login_attempts);
					$this->load->view('auth/login');
				}
			} else {
				$this->session->set_flashdata('message', 'Email / Username tidak aktif');
				$login_attempts = ($login_attempts) ? $login_attempts + 1 : 1;
				$this->session->set_userdata('login_attempts', $login_attempts);
				$this->load->view('auth/login');
			}
		} else {
			$this->session->set_flashdata('message', 'Email / Username tidak terdaftar');
			$login_attempts = ($login_attempts) ? $login_attempts + 1 : 1;
			$this->session->set_userdata('login_attempts', $login_attempts);
			redirect('/index.php/auth');
		}
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();

		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				if (time() - $user_token['date_created'] < (60 * 60 * 12)) {
					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('tb_user');
					$this->db->delete('user_token', ['email' => $email]);
					$this->session->set_flashdata('sukses', 'Akun ' . $email . ' Berhasil diaktifkan, silahkan login');
					redirect('/index.php/auth');
				} else {
					$this->db->delete('user_token', ['email' => $email]);
					$this->session->set_flashdata('message', 'Link aktivasi kedaluarsa');
					redirect('/index.php/auth');
				}
			} else {
				$this->session->set_flashdata('message', 'Link tidak berlaku / salah');
				redirect('/index.php/auth');
			}
		} else {
			$this->session->set_flashdata('message', 'Link tidak berlaku / salah');
			redirect('/index.php/auth');
		}
	}
	public function resetpassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();
		if ($user) {
			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
			if ($user_token) {
				if (time() - $user_token['date_created'] < 240) {
					$this->session->set_userdata('reset_email', $email);
					$this->changePassword();
					$this->db->delete('user_token', ['email' => $email]);
				} else {
					$this->db->delete('user_token', ['email' => $email]);
					$this->session->set_flashdata('message', 'Link sudah kedaluarsa');
					redirect('/index.php/auth');
				}
			} else {
				$this->session->set_flashdata('message', 'Link tidak berlaku / salah');
				redirect('/index.php/auth');
			}
		} else {
			$this->session->set_flashdata('message', 'Link tidak berlaku / salah');
			redirect('/index.php/auth');
		}
	}
	public function changePassword()
	{
		$data['title'] = 'Dashboard - Ganti Password';
		$data['user'] = $this->m_user->get_user();
		$this->load->view('usertemplate/header', $data);
		$this->load->view('ubahpassword/top', $data);
		$this->load->view('ubahpassword/sidebar');
		$this->load->view('ubahpassword/reset');
	}
	public function makepassword()
	{
		$data['title'] = 'Dashboard - Ganti Password';
		$data['user'] = $this->m_user->get_user();
		$this->load->view('usertemplate/header', $data);
		$this->load->view('ubahpassword/top', $data);
		$this->load->view('ubahpassword/sidebar');
		$this->load->view('ubahpassword/index');
	}
}