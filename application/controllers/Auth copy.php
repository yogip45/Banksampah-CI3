<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {	
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
		//untuk captcha
		$config = [
			'img_path' => './captcha/',
			'img_url' => base_url('captcha'),
			'img_width' => 140,
			'img_height' => 40,
			'border' => 1,
			'expiration' => 3600,
			'word_length' => 5,
			'font_size' => 20,
			'font_path' => './fonts/Roboto-BlackItalic.ttf',
			'pool' => '0123456789',
			'colors'        => array(
				'background' => array(255, 255, 255),
				'border' => array(255, 255, 255),
				'text' => array(0, 0, 0),
				'grid' => array(255, 40, 40)
			)
		];

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
			$this->form_validation->set_rules('email','Email','trim|required');
			$this->form_validation->set_rules('password','Password','trim|required');
			
			if ($this->form_validation->run() == false)
			{				
				$captcha = create_captcha($config);
				if ($captcha !== FALSE) {
					// echo $captcha['image'];
					$data['image'] = $captcha['image'];
				} else {
						die('No captcha was created');
				}
				$this->session->set_userdata('captcha_word',$captcha['word']);
					$this->load->view('auth/login',$data);
				} else {
					//validasi berhasil
					$this->_login();
				}
			}
	}

	public function changepassword(){
		if ($this->session->userdata('email')) {
			$data['title'] = "Dashboard - Ganti Password";
			$data['user'] = $this->m_user->get_user();
			$this->load->view('usertemplate/header',$data);
			$this->load->view('ubahpassword/top',$data);
			$this->load->view('ubahpassword/sidebar');
			$this->load->view('ubahpassword/index');
			$this->load->view('newtemplate/footer');
		} else {
			redirect('index.php/auth');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->set_flashdata('sukses','Berhasil Logout');
		redirect('/index.php/auth');
	}
	private function _login()
	{
		// $this->ClearCaptcha();
		$email = $this->input->post('email');		
		$password = $this->input->post('password');
		$currentCaptcha = $this->session->userdata('captcha_word');
		$answer = $this->input->post('captcha');
		$this->ClearCaptcha();
		
		$user = $this->db->get_where('tb_user',['email'=>$email])->row_array();		
		$username = $this->db->get_where('tb_user',['username'=>$email])->row_array();
		if ($answer == $currentCaptcha) {
			if ($user) {
				//emailnya ada and aktif
				if ($user['is_active']==1) 
				{
					//cek passwd
					if (password_verify($password,$user['password']))
					{
						$data = [
							'email'=>$user['email'],
							'role'=>$user['role'],
							'username'=>$user['username'],						
							'id_user'=>$user['id_user'],						
							'default_password'=>$user['default_password'],						
						];
						$this->db->set('last_login', 'NOW()', FALSE);
						$this->db->where('email', $user['email']);
						$this->db->update('tb_user');
						$this->session->set_userdata($data);
						
						if ($user['role']==3) {
							if ($this->session->userdata('default_password')==0) {			
								redirect('/index.php/admin/dashboard');
							} else {
								redirect('/index.php/auth/changepassword');
							}
						} elseif ($user['role']==2){
							if ($this->session->userdata('default_password')==0) {							
								redirect('/index.php/petugas/dashboard');
							} else {
								redirect('/index.php/auth/changepassword');
							}											
						} elseif ($user['role']==1){
							if ($this->session->userdata('default_password')==0) {							
								redirect('/index.php/nasabah/dashboard');
							} else {
								redirect('/index.php/auth/changepassword');
							}
						}
					}else {
						$this->session->set_flashdata('message','Password Salah');
						// $this->load->view('auth/login');
						redirect('/index.php/auth');
					}
				}else {
					$this->session->set_flashdata('message','Email / Username tidak aktif');
					redirect('/index.php/auth');
				}
			} 
			//JIKA LOGIN PAKAI USERNAME
			elseif ($username) {
				if ($username['is_active']==1) 
				{
					//cek passwd
					if (password_verify($password,$username['password']))
					{
						$this->ClearCaptcha();
						$data = [
							'email'=>$username['email'],
							'role'=>$username['role'],
							'username'=>$username['username'],						
							'id_user'=>$username['id_user'],						
							'default_password'=>$username['default_password'],						
						];
						$this->db->set('last_login', 'NOW()', FALSE);
						$this->db->where('email', $username['email']);
						$this->db->update('tb_user');
						$this->session->set_userdata($data);
						
						if ($username['role']==3) {
							if ($this->session->userdata('default_password')==0) {			
								redirect('/index.php/admin/dashboard');
							} else {
								redirect('/index.php/auth/changepassword');
							}
						} elseif ($username['role']==2){
							if ($this->session->userdata('default_password')==0) {							
								redirect('/index.php/petugas/dashboard');
							} else {
								redirect('/index.php/auth/changepassword');
							}											
						} elseif ($username['role']==1){
							if ($this->session->userdata('default_password')==0) {							
								redirect('/index.php/nasabah/dashboard');
							} else {
								redirect('/index.php/auth/changepassword');
							}
						}
					}else {
						$this->session->set_flashdata('message','Password Salah');
						$this->load->view('auth/login');
					}
				}else {
					$this->session->set_flashdata('message','Email / Username tidak aktif');
					$this->load->view('auth/login');
				}
			
			}else {
				$this->session->set_flashdata('message','Email / Username tidak terdaftar');
				redirect('/index.php/auth');
			}
		}	else {
			$this->session->set_flashdata('message','Captcha Salah');
			redirect('/index.php/auth');

		}
	}

	private function ClearCaptcha() {
		// Path direktori captcha
		$captchaDir = './captcha/';
		// Hapus semua file di direktori captcha
		$files = get_filenames($captchaDir);

		foreach ($files as $file) {
			// Check if the file exists before attempting to delete
			if (file_exists($captchaDir . $file)) {
					unlink($captchaDir . $file);
			}
	}
}
}
