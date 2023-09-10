<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authpetugas extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		// $this->load->library('password');
	}

	public function dashboard()
	{
		$data['user'] = $this->db->get_where('tb_user',['email'
		=> $this->session->userdata('email')])->row_array();
		$this->load->view('template/header');
		$this->load->view('template/top', $data);
		$this->load->view('template/sidebar');
		$this->load->view('admin/dashboard',$data);
	}

	public function index()
	{
		$this->form_validation->set_rules('email','Email','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');

		if ($this->form_validation->run() == false)
		{
			$this->load->view('auth/loginpetugas');
		} else {
			//validasi berhasil
			$this->_login();			
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->set_flashdata('sukses','Berhasil Logout');
		redirect('authpetugas');
	}
	private function _login()
	{
		$email = $this->input->post('email');
		$id_petugas = $this->input->post('email');
		$password = $this->input->post('password');
		
		$user = $this->db->get_where('tb_petugas',['email'=>$email])->row_array();		
		$petugas = $this->db->get_where('tb_petugas',['id_petugas'=>$id_petugas])->row_array();		

		if ($user) {
			//emailnya ada and aktif
			if ($user['is_active']==1) 
			{
				//cek passwd
				if (password_verify($password,$user['password']))
				{
					$data = [
						'email'=>$user['email'],
						// 'nama'=>$user['nama']
					];		
					$this->session->set_userdata($data);
					redirect('/authpetugas/dashboard');
				}else {
					$this->session->set_flashdata('message','Password Salah');
					$this->load->view('auth/loginpetugas');
				}
			}else {
				$this->session->set_flashdata('message','Email / Username tidak aktif');
				$this->load->view('auth/loginpetugas');
			}
		} 
		elseif ($petugas) {
			if ($petugas['is_active']==1) 
			{
				//cek passwd
				if (password_verify($password,$petugas['password']))
				{
					$data = [
						'email'=>$petugas['email'],
						// 'nama'=>$user['nama']
					];		
					$this->session->set_userdata($data);
					redirect('/authpetugas/dashboard');
				}else {
					$this->session->set_flashdata('message','Password Salah');
					$this->load->view('auth/loginpetugas');
				}
			}else {
				$this->session->set_flashdata('message','Email / Username tidak aktif');
				$this->load->view('auth/loginpetugas');
			}
		
		}else {
			$this->session->set_flashdata('message','Email / Username tidak terdaftar');
			$this->load->view('auth/loginpetugas');
		}
	}
}
