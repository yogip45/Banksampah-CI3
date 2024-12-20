<?php
  class M_jns_sampah extends CI_Model
  {
    public function tampil_data()
    {
      $this->db->select('jns_sampah.*, tb_stok.jumlah');
      $this->db->from('jns_sampah');
      $this->db->join('tb_stok', 'jns_sampah.id_sampah = tb_stok.id_sampah', 'left');
      return $this->db->get();
      
    }
    public function tampil_sampah_with_stok()
    {
      $this->db->where('jumlah !=', 0);
      $query = $this->db->get('tb_stok');
      return $query;
    }
    public function input_data($data){
      $this->db->insert('jns_sampah', $data);
    }
    public function hapus_data($where,$table){
      $this->db->where($where);
      $this->db->delete($table);
    }
    public function edit_data($where,$table)
    {
      return $this->db->get_where($table,$where);
      
    }
    
    public function update_data($where,$data,$table)
    {
      $this->db->where($where);
      $this->db->update($table,$data);      
    }
  }