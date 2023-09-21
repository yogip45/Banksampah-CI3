<?php
  class M_setoran extends CI_Model
  {
    public function tampil_data()
    {      
      $this->db->select('tb_setoran.*, tb_nasabah.nama', 'tb_nasabah.nin');
      $this->db->from('tb_setoran');
      $this->db->join('tb_nasabah', 'tb_setoran.nin = tb_nasabah.nin', 'left');
      return $this->db->get();      
    }
    public function get_nasabah($id_setor){
      $this->db->select('tb_setoran.*, tb_nasabah.nama, tb_nasabah.nin, tb_nasabah.saldo');
      $this->db->from('tb_setoran');
      $this->db->join('tb_nasabah', 'tb_setoran.nin = tb_nasabah.nin', 'left');
      $this->db->where('tb_setoran.id_setor', $id_setor); // Tambahkan kondisi WHERE
      return $this->db->get()->row_array();
    }
    public function tampil_detail($id_setor)
    {
      $this->db->where('id_setor', $id_setor);
      return $this->db->get('tb_detail_setoran');
    }
    public function input_setoran($data,$id_setor)
    {
      $this->db->insert('tb_setoran', $data);
      $this->session->set_flashdata('sukses','Berhasil Ditambahkan');
			redirect('/index.php/setoran/detail_setoran/'.$id_setor);
      
      // return true;
    }
    public function input_detail($data,$id_setor)
    {
      $this->db->insert('tb_detail_setoran', $data);
      $this->session->set_flashdata('sukses','Berhasil Ditambahkan');
			redirect('/index.php/setoran/detail_setoran/'.$id_setor);
      
      // return true;
    }
    public function ubahstatus()
{
    $data = array('status' => 1);
    $this->db->update('tb_detail_transaksi', $data);
}
    // public function input_detail($data)
    // {
    //   $nin = $data['nin'];    
    //   $this->db->trans_begin();
      
    //   $this->db->insert('tb_setoran', $data);
      
    //   $this->db->set('saldo', 'saldo + ' . $data['total'], false);
    //   $this->db->where('nin', $nin);
    //   $this->db->update('tb_nasabah');      
      
    //   if ($this->db->trans_status() === false) {
    //       $this->db->trans_rollback();          
    //       $this->session->set_flashdata('error', 'Gagal menambahkan setoran');
    //       redirect('/index.php/setoran/tambah_setoran');
    //   }      
    //   $this->db->trans_commit();
    //   $this->session->set_flashdata('sukses','Berhasil Ditambahkan');
		// 	redirect('/index.php/setoran/tambah_setoran');
    // }

    public function get_keyword($keyword)
    {
      $this->db->select('*');
      $this->db->from('tb_setoran');
      $this->db->like('nin', $keyword);

      return $this->db->get()->result();
    }


  }
?>