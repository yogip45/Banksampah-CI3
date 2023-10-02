<?php
class Stok extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('m_nasabah');
		$this->load->model('m_petugas');
		$this->load->model('m_user');                  
		$this->load->model('m_jns_sampah');
		$this->load->model('m_setoran');
		$this->load->model('m_stok');
		date_default_timezone_set('Asia/Jakarta');
	}

	public function barangkeluar()
	{
		if ($this->session->userdata('email')) {
				if ($this->session->userdata('role')==2 || $this->session->userdata('role')==3) {
					$data['title'] = "Dashboard - Transaksi Barang Keluar";
					$data['user'] = $this->m_user->get_user();
					$data['barangkeluar'] = $this->m_stok->tampil_barangkeluar();
					$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
					$this->load->view('newtemplate/header',$data);
					$this->load->view('newtemplate/top',$data);
					$this->load->view('newtemplate/sidebar',$data);
					$this->load->view('transaksi/barangkeluar',$data);	
					$this->load->view('newtemplate/footer');
				} else {
					$this->load->view('error/403');
				}
			} else {			
				redirect('/index.php/auth');
			}
	}

	public function create_barangkeluar()
	{
		if ($this->session->userdata('email')) {
				if ($this->session->userdata('role')==2 || $this->session->userdata('role')==3) {
					$this->form_validation->set_rules('tgl_keluar','Tanggal Keluar','required|trim',
					array('required'=>'Tanggal Harus Diisi')
					);
					$this->form_validation->set_rules('id_sampah','Sampah','required|trim',
					array('required'=>'Pilih Sampah Dulu')
					);								
					$this->form_validation->set_rules('jumlah','Jumlah','required|trim',
					array('required'=>'Masukkan Jumlah Sampah')
					);								
					$this->form_validation->set_rules('total','Total','required|trim',
					array('required'=>'Total Penjualan Harus Diisi')
					);								
					if ($this->form_validation->run() == false) {
						$data['title'] = "Dashboard - Transaksi Barang Keluar";
						$data['user'] = $this->m_user->get_user();
						$data['barangkeluar'] = $this->m_stok->tampil_barangkeluar();
						$data['jns_sampah'] = $this->m_jns_sampah->tampil_data()->result();
						$data['max_stok'] = $this->m_stok->max_barangkeluar();
						$this->load->view('newtemplate/header',$data);
						$this->load->view('newtemplate/top',$data);
						$this->load->view('newtemplate/sidebar',$data);
						$this->load->view('transaksi/barangkeluar',$data);	
						$this->load->view('newtemplate/footer');
					} else {
						$id = getAutoNumber('tb_barangkeluar','id','BK','5');
						$tgl_keluar = $this->input->post('tgl_keluar');
						$id_sampah = $this->input->post('id_sampah');
						$jumlah = $this->input->post('jumlah');
						$total = $this->input->post('total');

						$data = array(
							'id' => $id,
							'id_sampah' => $id_sampah,
							'tgl_keluar' => $tgl_keluar,
							'jumlah' => $jumlah,
							'total' => $total,
						);
						$this->m_stok->input_barangkeluar($data);
						redirect('index.php/stok/barangkeluar');
					}
				} else {
					$this->load->view('error/403');
				}
			} else {			
				redirect('/index.php/auth');
			}
		
	}
	public function max_barangkeluar()
	{
		if ($this->session->userdata('email')) {
			if ($this->session->userdata('role')==2 || $this->session->userdata('role')==3) {
				$id_sampah = $this->input->post('id_sampah');
				$jumlah = $this->m_stok->get_jumlah_by_id_sampah($id_sampah);
				echo json_encode($jumlah);
			} else {
				$this->load->view('error/403');
			}
		} else {			
			redirect('/index.php/auth');
		}
	}
}
