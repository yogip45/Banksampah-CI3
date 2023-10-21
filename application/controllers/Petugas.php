<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// IF SUDAH LOGIN
// if ($this->session->userdata('email')) {
// } else {
// 	$this->session->set_flashdata('message','Login dulu');
// 	redirect('auth');
// }

class Petugas extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('m_nasabah');
		$this->load->model('m_petugas');
		$this->load->model('m_user');                  
		$this->load->model('m_jns_sampah');
		$this->load->model('m_alamat');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function dashboard()
	{
		if ($this->session->userdata('email')) {
			$this->load->model('m_nasabah');
			$this->load->model('m_user');              		
			$this->load->model('m_petugas');              		
			$data['title'] = 'Dashboard - Home Petugas';
			$data['user'] = $this->m_petugas->get_petugas();
			$data['jumlah'] = $this->m_petugas->hitung();			
			$this->load->view('newtemplate/header',$data);
			$this->load->view('newtemplate/top',$data);
			$this->load->view('newtemplate/sidebar');
			$this->load->view('petugas/dashboard',$data);
		} else {
			redirect('/index.php/auth');
		}
	}	
	// FUNGSI UNTUK NASABAH
	public function nasabahindex()
	{
			if ($this->session->userdata('email')) {
				if ($this->session->userdata('role')==2 || $this->session->userdata('role')==3) {
					$data['title'] = "Dashboard - Data Nasabah";
					$data['user'] = $this->m_user->get_user();
					$data['nasabah'] = $this->m_nasabah->tampil_data()->result();
					$this->load->view('newtemplate/header',$data);
					$this->load->view('newtemplate/top',$data);
					$this->load->view('newtemplate/sidebar');
					$this->load->view('nasabah/nasabahindex',$data);	
					$this->load->view('newtemplate/footer');
				} else {
					$this->load->view('error/403');
				}
			} else {			
				redirect('/index.php/auth');
			}				
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
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==3 || $this->session->userdata('role')==2 ) {
				$getdata = $this->m_alamat->getdatakecamatan();
				$data['alamat'] = $getdata;
				$data['title'] = "Dashboard - Form Tambah Nasabah";
				$data['user'] = $this->m_user->get_user();
				$this->load->view('newtemplate/header',$data);
				$this->load->view('newtemplate/top',$data);
				$this->load->view('newtemplate/sidebar',$data);
				$this->load->view('nasabah/nasabahtambah',$data);
				$this->load->view('newtemplate/footer');
			} else {
				$this->load->view('error/403');
			}
		} else {	
			redirect('/index.php/auth');
		}
	}	
	public function create_nasabah()
	{
		if ($this->session->userdata('email')) {
			$this->load->model('m_nasabah');
			$this->load->model('m_user');
			
		$this->form_validation->set_rules('nama','Nama','required|trim',
		array('required'=>'Nama Harus Diisi')
		);
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[tb_user.email]',
		array('required'=>'Email Harus Diisi','valid_email'=>'Alamat Email Tidak Valid','is_unique'=>'Alamat Email Sudah Digunakan')
		);		
		$this->form_validation->set_rules('id_desa','Desa','required|trim',
		array('required'=>'Desa Harus Diisi')
		);
		$this->form_validation->set_rules('id_kecamatan','Kecamatan','required|trim',
		array('required'=>'Kecamatan Harus Diisi')
		);		
		$this->form_validation->set_rules('alamat_lengkap','Alamat_lengkap','required|trim',
		array('required'=>'Alamat Harus Diisi')
		);
		$this->form_validation->set_rules('rt','Rt','required|trim',
		array('required'=>'Rt Harus Diisi')
		);
		$this->form_validation->set_rules('rw','Rw','required|trim',
		array('required'=>'Rw Harus Diisi')
		);
		$this->form_validation->set_rules('password1','Password','required|trim|min_length[8]',
		array(
			'required'=>'Password Harus Diisi',
			'min_length'=>'Minimal 8 karakter',
			'matches'=>'Password tidak cocok',)
		);
		if ($this->form_validation->run() == false) {
				$getdata = $this->m_alamat->getdatakecamatan();
				$data['alamat'] = $getdata;
				$data['title'] = "Dashboard - Form Tambah Nasabah";
				$data['user'] = $this->m_user->get_user();
				$this->load->view('newtemplate/header',$data);
				$this->load->view('newtemplate/top',$data);
				$this->load->view('newtemplate/sidebar',$data);
				$this->load->view('nasabah/nasabahtambah',$data);
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
				'id_user' =>$kodeunik,
				'username' => $nin,
				'role' => 1,
				'email' => $email,
				'password' =>password_hash($password,PASSWORD_DEFAULT),
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
				'id_user' =>$kodeunik,
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
			
			$this->m_user->input_data($data,'tb_user');
			$this->m_nasabah->input_data($data1,'tb_nasabah');
			$this->db->insert('user_token',$user_token);
			$this->_sendEmail($token);
			$this->session->set_flashdata('sukses','Data Berhasil Ditambahkan');
			redirect('/index.php/petugas/nasabahindex');
		}
		} else {		
			redirect('/index.php/auth');
		}

	}
	private function _sendEmail($token)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'cikrakjatimulyo@gmail.com',
			'smtp_pass' => 'mpsw yjod ohga qlsx',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email',$config);
		$this->email->initialize($config);

		$this->email->from('cikrakjatimulyo@gmail.com','Tim Cikrak Jatimulyo');
		$this->email->to($this->input->post('email'));


		$this->email->subject('Aktivasi Akun Banksampah');

		$message = 'Hallo, ' . $this->input->post('nama') . '<br><br>';
		$message .= 'Terima kasih telah mendaftar di Bank Sampah. Untuk melanjutkan, silakan aktifkan akun Anda dengan mengeklik tombol di bawah ini:<br><br>';
		$message .= '<div style="text-align:left;"><a href="' . base_url() . 'index.php/auth/verify?email=' . urlencode($this->input->post('email')) . '&token=' . urlencode($token) . '" style="background-color:#4CAF50; color:white; padding:10px 20px; text-decoration:none; border-radius:5px; display:inline-block;">Aktifkan Akun</a></div><br><br>';
		$message .= 'Jika tombol di atas tidak berfungsi, Anda juga dapat menyalin dan menempelkan tautan berikut ini ke peramban web Anda: ' . base_url() . 'index.php/auth/verify?email=' . urlencode($this->input->post('email')) . '&token=' . urlencode($token) . '<br><br>';
		$message .= 'Terima kasih, dan selamat bergabung dengan Bank Sampah.';

		$this->email->message($message);
		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}
	public function hapus_nasabah($id_user)
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2 || $this->session->userdata('role')==3) {				
				$this->load->model('m_nasabah');
				$this->load->model('m_user');
		
				$where = array ('id_user'=>$id_user);
				$this->m_nasabah->hapus_data($where, 'tb_nasabah');
				$this->m_user->hapus_data($where, 'tb_user');
				$this->session->set_flashdata('hapus','Data Berhasil Dihapus');
				redirect('/index.php/petugas/nasabahindex');
			} else {
				$this->load->view('error/403');
			}
		} else {
				$this->session->set_flashdata('message','Login dulu');
				redirect('/index.php/auth');
			}
	}

	public function edit_nasabah($id_user)
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2||$this->session->userdata('role')==3) {
				$data['title'] = "Dashboard - Edit Nasabah";
				$data['user'] = $this->m_user->get_user();
				$this->load->model('m_nasabah');
				$this->load->model('m_user');
				$data['kecamatan'] = $this->m_alamat->getdatakecamatan();
				$data['nasabah'] = $this->m_nasabah->get_user_nasabah_data($id_user);
				$this->load->view('newtemplate/header',$data);
				$this->load->view('newtemplate/top',$data);
				$this->load->view('newtemplate/sidebar',$data);
				$this->load->view('nasabah/nasabahedit',$data);
				$this->load->view('newtemplate/footer',$data);
			} else {
				redirect('/index.php/auth');
			}
			} else {			
			redirect('/index.php/auth');
		}
	}
	public function update_nasabah()
	{			
		if ($this->session->userdata('email')) {

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
				'id_user'=>$id_user
			);
			
			$this->m_user->update_data($where,$data,'tb_user');
			$this->m_nasabah->update_data($where,$data1,'tb_nasabah');
			$this->session->set_flashdata('edit','Data Berhasil Diubah!');
			redirect('/index.php/petugas/nasabahindex');
		} else {
			redirect('/index.php/auth');
		}		
	}
	public function ubahstatus_nasabah($id_user)
	{		
		$this->load->model('m_user');

    $where = array ('id_user' => $id_user);
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
		redirect('/index.php/petugas/nasabahindex');
	}

	public function resetpassword_nasabah($id_user)
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role') == 2 || $this->session->userdata('role') == 3) {
						$this->load->model('m_user');
						$this->load->model('m_nasabah');
						$default_password = generate_password(10);
						$nasabah = $this->m_nasabah->get_user_nasabah_data($id_user);
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
						$this->session->set_flashdata('password', $default_password);
						$this->session->set_flashdata('nasabah', $nasabah['nama']);
						redirect('/index.php/petugas/nasabahindex');
			} else {
				$this->load->view('error/403');																	 
			}
		} else {
				redirect('/index.php/auth');
		}
	}
	// FUNGSI UNTUK AMBIL DATA DESA
}
