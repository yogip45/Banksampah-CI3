<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// IF SUDAH LOGIN
// if ($this->session->userdata('email')) {
// } else {
// 	$this->session->set_flashdata('message','Login dulu');
// 	redirect('auth');
// }

class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('m_nasabah');
		$this->load->model('m_petugas');
		$this->load->model('m_user');                  
		$this->load->model('m_jns_sampah');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function dashboard()
	{		
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==3) {
				$data['title'] = "Dashboard - Home";
				$data['user'] = $this->m_petugas->get_petugas();
				$data['jumlah'] = $this->m_petugas->hitung();
				$this->load->view('newtemplate/header',$data);
				$this->load->view('newtemplate/top', $data);
				$this->load->view('newtemplate/sidebar',$data);
				$this->load->view('admin/dashboard',$data);
			} else {
				$this->load->view('error/403');
			}
		} else {
			redirect('index.php/auth');
		}		
	}

	public function petugasindex()	
	{
		//HARUS LOGIN DAN ROLE = 3 (SuperAdmin)
		if ($this->session->userdata('email')) {			
			if ($this->session->userdata('role') == 3) {					
					$data['title'] = "Dashboard - Data Petugas";
					$data['user'] = $this->m_petugas->get_petugas();					
					$data['petugas'] = $this->m_petugas->tampil_data()->result();
					$this->load->view('newtemplate/header', $data);
					$this->load->view('newtemplate/top', $data);
					$this->load->view('newtemplate/sidebar');
					$this->load->view('admin/petugasindex', $data);					
					$this->load->view('newtemplate/footer');					
			} else {					
					$this->load->view('error/403');
			}
		} else {			
				redirect('index.php/auth');
		}
	}

	public function tambah_petugas()
	{
			if ($this->session->userdata('email')) {
				$data['title'] = 'Dashboard - Tambah Data Petugas';			
				$data['user'] = $this->m_petugas->get_petugas();
				$this->load->view('newtemplate/header',$data);
				$this->load->view('newtemplate/top',$data);
				$this->load->view('newtemplate/sidebar');
				$this->load->view('admin/petugastambah');
				$this->load->view('newtemplate/footer');
			} else {			
				redirect('index.php/auth');
			}
	}	

	public function create_petugas()
	{
		if ($this->session->userdata('email')) {		
		$this->load->model('m_petugas');
		$this->load->model('m_user');

		$this->form_validation->set_rules('nama','Nama','required|trim',
		array('required'=>'Nama Harus Diisi')
		);
		$this->form_validation->set_rules('no_hp','No_hp','required|trim',
		array('required'=>'No HP Harus Diisi')
		);
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[tb_user.email]',
		array('required'=>'Email Harus Diisi','valid_email'=>'Alamat Email Tidak Valid','is_unique'=>'Alamat Email Sudah Digunakan')
		);
		$this->form_validation->set_rules('password1','Password','required|trim|min_length[8]|matches[password2]',
		array(
			'required'=>'Password Harus Diisi',
			'min_length'=>'Minimal 8 karakter',
			'matches'=>'Password tidak cocok',)
		);
		$this->form_validation->set_rules('password2','Password','required|trim|matches[password1]',
		array(
			'required'=>'Password Harus Diisi',			
			'matches'=>'Password tidak cocok',)
		);		
		if ($this->form_validation->run() == false) {
			$data['title'] = "Dashboard - Tambah Data Petugas";
			$data['user'] = $this->m_petugas->get_petugas();
			$this->load->view('newtemplate/header',$data);
			$this->load->view('newtemplate/top',$data);
			$this->load->view('newtemplate/sidebar');
			$this->load->view('admin/petugastambah');
			$this->load->view('newtemplate/footer');
		} else {
			$pembuat = $this->m_petugas->get_petugas();      
			$kodeunik = 'U' . uniqid();
			$nama = $this->input->post('nama');        
			$email = $this->input->post('email');        
			$no_hp = $this->input->post('no_hp');        
			$role = '2';
			$password = $this->input->post('password1');                               
			
			$data = array(
					//data ke tabel user            
					'id_user' => $kodeunik,
					'nama_petugas' => $nama,
					'email' => $email,
					'no_hp' => $no_hp,
					'username' => getAutoNumber('tb_user','username','PS','4'),                
					'password' =>password_hash($password,PASSWORD_DEFAULT),
					'role' => $role,
					'foto' => 'default.jpg',
					'is_active' => 1,
					'dibuat_oleh' => $pembuat['nama_petugas'],
					'default_password' => 1,
			);	
			$this->m_user->input_data($data,'tb_user');	
			$this->session->set_flashdata('sukses','Data Berhasil Ditambahkan');
			redirect('/index.php/admin/petugasindex');
		}
		} else {		
		redirect('/index.php/auth');
		}
	
	}

	public function edit_petugas($id_user)
	{
		if ($this->session->userdata('email')) {
				$this->load->model('m_petugas');
				$this->load->model('m_user');
				$data['title'] = 'Dashboard - Edit Data Petugas';
				$data['user'] = $this->m_petugas->get_petugas();												
				$data['petugas'] = $this->m_petugas->get_user_petugas_data($id_user);
				$this->load->view('newtemplate/header',$data);
				$this->load->view('newtemplate/top',$data);
				$this->load->view('newtemplate/sidebar');
				$this->load->view('admin/petugasedit');
				$this->load->view('newtemplate/footer');
			} else {			
			redirect('/index.php/auth');
		}
	}

	public function update_petugas()
	{	
		if ($this->session->userdata('email')) {
			
			$this->load->model('m_petugas');
			$this->load->model('m_user');

			$id_user = $this->input->post('id_user');						
			$nama = $this->input->post('nama_petugas');		
			$hp = $this->input->post('no_hp');		

			$data = array(				
				'nama_petugas' => $nama,
				'no_hp' => $hp,				
				'diedit' => date('Y-m-d H:i:s'),					
			);		
			
			$where = array(
				'id_user'=>$id_user
			);
			
			$this->m_user->update_data($where,$data,'tb_user');			
			$this->session->set_flashdata('sukses','Data Berhasil Diubah');
			redirect('/index.php/admin/petugasindex');
		} else {
				redirect('/index.php/auth');
		}
	}

	public function hapus_petugas($id_user)
	{
		if ($this->session->userdata('email')) {			
			$this->load->model('m_petugas');			
			$where = array ('id_user'=>$id_user);
			$this->m_petugas->hapus_data($where, 'tb_user');
			$this->m_petugas->hapus_data($where, 'tb_petugas');
			$this->session->set_flashdata('hapus','Data Berhasil Dihapus');
			redirect('/index.php/admin/petugasindex');
		} else {
				redirect('/index.php/auth');
		}
	}

	public function ubahstatus($id_user)
	{		
		$this->load->model('m_user');

    $where = array ('id_user' => $id_user);
    $table = 'tb_user';	

    // Ambil data user berdasarkan ID
    $user = $this->m_user->get_user_by_id($id_user);

    if ($user && isset($user['is_active'])) {
        if ($user['is_active'] == 1) {
            $data = array('is_active' => 0,'diedit' => date('Y-m-d H:i:s'));
        } else {
            $data = array('is_active' => 1,'diedit' => date('Y-m-d H:i:s'));
        }

        $this->m_user->change_status($where, $data, $table);
        $this->session->set_flashdata('sukses', 'Status Akun Berhasil diubah');
    } else {
        $this->session->set_flashdata('hapus', 'Akun tidak ditemukan');
    }
		redirect('/index.php/admin/petugasindex');
	}

	public function resetpassword($id_user)
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
							'diedit' => date('Y-m-d H:i:s'));					
						$this->m_user->reset_password($where, $data, $table);
						$this->session->set_flashdata('sukses', 'Password berhasil direset');
						redirect('/index.php/admin/petugasindex');
			} else {
				$this->load->view('error/403');																	 
			}
		} else {
				redirect('/index.php/auth');
		}
	}

	// ACTION NASABAH
	public function nasabahindex()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2 || $this->session->userdata('role')==3) {
				$data['title'] = "Dashboard - Data Nasabah";
				$data['user'] = $this->m_user->get_user();
				$data['nasabah'] = $this->m_nasabah->tampil_data()->result();
				$this->load->view('template/header',$data);
				$this->load->view('template/top',$data);
				$this->load->view('template/sidebar',$data);
				$this->load->view('nasabah/nasabahindex',$data);	
			} else {
				redirect('nasabah/index.php/dashboard');
			}
		} else {			
			redirect('/index.php/auth');
		}				
	}

	public function tambah_nasabah()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==3 || $this->session->userdata('role')==2 ) {
				$data['title'] = "Dashboard - Form Tambah Nasabah";
				$data['user'] = $this->m_user->get_user();
				$this->load->view('template/header',$data);
				$this->load->view('template/top',$data);
				$this->load->view('template/sidebar',$data);
				$this->load->view('nasabah/nasabahtambah',$data);
			} else {
				redirect('/index.php/auth');
			}
		} else {	
			redirect('/index.php/auth');
		}
	}
	// ACTION NASABAH
}
