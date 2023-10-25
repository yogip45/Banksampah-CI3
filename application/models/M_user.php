<?php
  class M_user extends CI_Model
  {
    public function tampil_data()
    {
      return $this->db->get('tb_petugas');
      
    }
    // public function input_data($data)
    // {
    //   $this->db->insert('tb_nasabah', $data);
    // }
    public function hapus_data($where,$table)
    {
      $this->db->where($where);
      $this->db->delete($table);
    }    
    public function input_data($data)
    {
      $this->db->insert('tb_user', $data);
    }
    public function update_data($where,$data,$table)
    {
      $this->db->where($where);
      $this->db->update($table,$data);      
    }
    public function get_user_by_id($id_user)
    {
        return $this->db->get_where('tb_user', array('id_user' => $id_user))->row_array();
    }
    public function get_role_by_id($id_user)
    {
      $this->db->select('role');
      $this->db->where('id_user', $id_user);
      $query = $this->db->get('tb_user');
      return $query->row_array();
    }
    public function change_status($where, $data, $table)
    {
      $this->db->where($where);
      $this->db->update($table, $data);
    }

    public function reset_password($where, $data, $table)
    {
      $this->db->where($where);
      $this->db->update($table, $data);
    }

    public function get_user(){
      $data = $this->db->select('*')
            ->from('tb_user')            
            ->where('tb_user.email', $this->session->userdata('email'))
            ->get();
      return $data->row_array();
    }

    public function get_nasabah(){
      $data = $this->db->select('*')
            ->from('tb_user')
            ->join('tb_nasabah', 'tb_nasabah.id_user = tb_user.id_user', 'inner')
            ->where('tb_user.email', $this->session->userdata('email'))
            ->get();
      return $data->row_array();
    }

    public function get_foto($id_user){
      $this->db->select('foto');
      $this->db->where('id_user', $id_user);
      $query = $this->db->get('tb_user');

      if ($query->num_rows() > 0) {
          $row = $query->row();
          return $row->foto;
      } else {
          return null;
      }
    }
    public function update_foto($id_user, $foto){
      $data = array('foto' => $foto);
      $this->db->where('id_user', $id_user);
      $this->db->update('tb_user', $data);
    }
  }