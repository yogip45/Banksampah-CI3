<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landing extends CI_Controller
{

	public function index()
	{
		$this->load->library('session');
		$this->load->model('m_petugas');
		$data['jumlah'] = $this->m_petugas->hitung();
		$this->load->view('landing/index', $data);
	}

	public function contact_me()
	{
		$this->load->library('session');
		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'required|trim',
			array('required' => 'Nama Harus Diisi')
		);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email',
			array('required' => 'Email Harus Diisi', 'valid_email' => 'Alamat Email Tidak Valid')
		);
		$this->form_validation->set_rules(
			'subject',
			'Subject',
			'required|trim',
			array('required' => 'Isi Subject Pesan')
		);
		$this->form_validation->set_rules(
			'pesan',
			'Pesan',
			'required|trim',
			array('required' => 'Pesan belum diisi')
		);
		if ($this->form_validation->run() == false) {
			$this->load->model('m_petugas');
			$data['jumlah'] = $this->m_petugas->hitung();
			$this->load->view('landing/index', $data);
		} else {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$subject = $this->input->post('subject');
			$pesan = $this->input->post('pesan');
			$this->_sendEmail('contact_me', $nama, $email, $subject, $pesan);
			$this->session->set_flashdata('status', 'Pesan anda berhasil dikirim');
			redirect('index.php/landing');
		}
	}
	private function _sendEmail($type, $nama, $email, $subject, $pesan)
	{
		$config = [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'sentrajatimulyo@gmail.com',
			'smtp_pass' => 'fhnr swmc rpur ljwq',
			'smtp_port' => 465,
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);

		if ($type == 'contact_me') {
			$this->email->from($email, 'Pesan dari ' . $nama);
			$this->email->to('cikrakjatimulyo@gmail.com');
			$this->email->subject($subject);
			$message = '<div style="text-align: left;">';
			$message .= $pesan;
			$message .= '</div><br><br>';
			$this->email->message($message);
			$sent = false;
			if ($this->email->send()) {
				// echo "Pesan berhasil dikirim";
				$this->session->set_flashdata('isEmailSent', true);
			} else {
				echo $this->email->print_debugger();
				die;
			}
		}
	}
}
