<?php
  class M_alamat extends CI_Model
  {
    public function getdatakecamatan()
    {
      $query = $this->db->query("SELECT * FROM tb_kecamatan ORDER BY nama_kecamatan ASC");
      
      return $query->result();
    }
    public function getdatadesa($id_kecamatan)
    {
      $query = $this->db->query("SELECT * FROM tb_desa 
      WHERE id_kecamatan = '$id_kecamatan' ORDER BY nama_desa ASC");
      
      return $query->result();
    }
    public function tampil_desa($id_kecamatan)
    {
      // Sesuaikan nama tabel dan kolom sesuai dengan struktur database Anda
      $this->db->select('id_desa, nama_desa');
      $this->db->from('tb_desa');
      $this->db->where('id_kecamatan', $id_kecamatan);

      $query = $this->db->get();

      if ($query->num_rows() > 0) {
          return $query->result();
      } else {
          return array(); // Mengembalikan array kosong jika tidak ada hasil
      }
    }
  }