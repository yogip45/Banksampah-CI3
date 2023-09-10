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
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('password','Password','trim|required');
			
			if ($this->form_validation->run() == false)
			{
				// if ($this->session->userdata('email')) {				
					// 	redirect('/auth/dashboard');
					// }
					$this->load->view('auth/login');
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
		$email = $this->input->post('email');		
		$password = $this->input->post('password');
		
		$user = $this->db->get_where('tb_user',['email'=>$email])->row_array();		
		$username = $this->db->get_where('tb_user',['username'=>$email])->row_array();		
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
					$this->load->view('auth/login');
				}
			}else {
				$this->session->set_flashdata('message','Email / Username tidak aktif');
				$this->load->view('auth/login');
			}
		} 
		elseif ($username) {
			if ($username['is_active']==1) 
			{
				//cek passwd
				if (password_verify($password,$username['password']))
				{
					$data = [
						'email'=>$username['email'],
						'role'=>$user['role'],
						'username'=>$user['username'],
					];		
					$this->session->set_userdata($data);
					redirect('auth');
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
			$this->load->view('auth/login');
		}
	}
}
