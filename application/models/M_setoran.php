<?php
  class M_setoran extends CI_Model
  {
    public function tampil_data()
    {
      $this->db->select('*');
      $this->db->from('tb_setoran');      
      return $this->db->get();      
    }
    public function input_data($data)
    {
      $nin = $data['nin'];    
      $this->db->trans_begin();
      
      $this->db->insert('tb_setoran', $data);
      
      $this->db->set('saldo', 'saldo + ' . $data['total'], false);
      $this->db->where('nin', $nin);
      $this->db->update('tb_nasabah');      
      
      if ($this->db->trans_status() === false) {
          // Transaksi gagal
          $this->db->trans_rollback(); // Batalkan transaksi          
          $this->session->set_flashdata('error', 'Gagal menambahkan setoran');
          redirect('/index.php/setoran/tambah_setoran');
          // return false;
      }      
      // Transaksi berhasil
      $this->db->trans_commit();
      $this->session->set_flashdata('sukses','Berhasil Ditambahkan');
			redirect('/index.php/setoran/tambah_setoran');
      // return true;
    }


  }
?>