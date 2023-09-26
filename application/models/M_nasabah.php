<?php
  class M_nasabah extends CI_Model
  {
    public function tampil_data()
    {
      $this->db->select('*');
      $this->db->from('tb_nasabah');
      $this->db->join('tb_user', 'tb_user.id_user = tb_nasabah.id_user', 'inner');      
      return $this->db->get();
      
    }    

    public function input_data($data)
    {
      $this->db->insert('tb_nasabah', $data);
    }
    public function hapus_data($where,$table)
    {
      $this->db->where($where);
      $this->db->delete($table);
    }    
    public function edit_data($where,$table)
    {
      return $this->db->get_where($table,$where);
      
    }
    public function get_user_nasabah_data($id_user) {
      $this->db->select('*');
      $this->db->from('tb_user');
      $this->db->join('tb_nasabah', 'tb_nasabah.id_user = tb_user.id_user', 'inner');
      $this->db->where('tb_user.id_user', $id_user);

      return $this->db->get()->result();
    }
    public function update_data($where,$data,$table)
    {
      $this->db->where($where);
      $this->db->update($table,$data);      
    }
    public function change_status($where,$data,$table)
    {
      
    }
    public function getSaldoByNin($nin)
    {
      $this->db->select('saldo');
      $this->db->where('nin', $nin);
      $query = $this->db->get('tb_nasabah');

      if ($query->num_rows() > 0) {
          return $query->row()->saldo;
      } else {
          return 0; // Atau nilai default lain jika nin tidak ditemukan.
      }
    }
  }