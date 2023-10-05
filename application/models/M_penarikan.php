<?php
  class M_penarikan extends CI_Model
  {
    public function tampil_data()
    {      
      $this->db->select('tb_penarikan.*');
      $this->db->from('tb_penarikan');
      return $this->db->get();
    }
    public function getdata_nasabah($nin)
    {
        $this->db->where('nin', $nin);
        return $this->db->get('tb_nasabah')->result();
    }
    public function get_saldo($nin)
    {
      $this->db->select('tb_nasabah.saldo');
      $this->db->from('tb_nasabah');
      $this->db->where('nin', $nin);
      return $this->db->get()->row_array();
    }
    public function input_penarikan($data)
    {
      return $this->db->insert('tb_penarikan', $data);
    }
    public function ambil_saldo($jumlah_penarikan,$nin)
    {
      $this->db->where('nin', $nin);
      $this->db->set('saldo', 'saldo - ' . $jumlah_penarikan, FALSE);
      return $this->db->update('tb_nasabah');
    }
  }
?>