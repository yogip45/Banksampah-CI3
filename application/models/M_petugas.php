<?php
  class M_petugas extends CI_Model
  {
    public function tampil_data()
    {
      $this->db->select('*');
      $this->db->from('tb_user');      
      $this->db->where('tb_user.role', 2); // Filter for role=2
      $this->db->or_where('tb_user.role', 3); // Filter for role=3
      return $this->db->get();      
    }
    public function get_petugas() {
      $data = $this->db->select('tb_user.id_user,tb_user.nama_petugas, tb_user.role, tb_user.foto')
        ->from('tb_user')        
        ->where('tb_user.email', $this->session->userdata('email'))
        ->get();
      return $data->row_array();
    }

    public function hitung(){
      $transaksi_setoran = $this->db->count_all('tb_setoran');
      $transaksi_penarikan = $this->db->count_all('tb_penarikan');
      $transaksi_barangkeluar = $this->db->count_all('tb_barangkeluar');
      $total_transaksi = $transaksi_setoran + $transaksi_penarikan + $transaksi_barangkeluar;
      $this->db->select_sum('jumlah', 'total_berat');
      $this->db->from('tb_stok');
      $result = $this->db->get()->row();

      $total_berat = $result->total_berat;
      $this->db->where('role', 2);
      $count_petugas = $this->db->count_all_results('tb_user');
      $jumlah = array(
        'nasabah' => $this->db->count_all('tb_nasabah'),
        'sampah' => $total_berat,
        'petugas' => $count_petugas,
        'transaksi' => $total_transaksi
      );
    return $jumlah;
    }
    public function hapus_data($where,$table)
    {
      $this->db->where($where);
      $this->db->delete($table);
    }    
    public function get_user_petugas_data($id_user)
    {
      $this->db->select('*');
      $this->db->from('tb_user');      
      $this->db->where('tb_user.id_user', $id_user);
      return $this->db->get()->result();
    }
    public function update_data($where,$data,$table)
    {
      $this->db->where($where);
      $this->db->update($table,$data);      
    }
    public function input_data($data1)
    {
      $this->db->insert('tb_petugas', $data1);
    }
  }