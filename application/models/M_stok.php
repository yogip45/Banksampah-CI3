<?php
  class M_stok extends CI_Model
  {
    public function tampil_data()
    {
      $this->db->select('tb_stok.*, jns_sampah.nama_sampah');
      $this->db->from('tb_stok');
      $this->db->join('jns_sampah', 'jns_sampah.id_sampah = tb_stok.id_sampah', 'inner');
      return $this->db->get()->result();
    }
    public function get_jumlah($id_sampah)
    {
      $this->db->select('tb_stok.jumlah');
      $this->db->from('tb_stok');
      $this->db->where('id_sampah', $id_sampah);
      return $this->db->get()->row_array();
    }
    public function get_jumlah_by_id_sampah($id_sampah)
    {
      $this->db->select('tb_stok.jumlah');
      $this->db->from('tb_stok');
      $this->db->where('id_sampah', $id_sampah);
      return $this->db->get()->result();
    }
    public function input_data($data){
      $this->db->insert('tb_stok', $data);
    }
    public function input_barangkeluar($data){
      $this->db->insert('tb_barangkeluar', $data);
    }
    public function hapus_data($where,$table){
      $this->db->where($where);
      $this->db->delete($table);
    }
    public function ambil_stok($input,$id_sampah)
    {
      $this->db->where('id_sampah', $id_sampah);
      $this->db->set('jumlah', 'jumlah - ' . $input, FALSE);
      $this->db->update('tb_stok');
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
    public function get_stok($id_sampah)
    {
    return $this->db->get_where('tb_stok', array('id_sampah' => $id_sampah))->row();
    }

    public function updateBeratByIdSampah($id_sampah, $total_berat)
    {
      $this->db->where('id_sampah', $id_sampah);
      $data = array('jumlah' => $total_berat);
      $this->db->update('tb_stok', $data);
    }
    public function hitungTotalBeratByIdSampah($id_sampah)
    {
      $this->db->select_sum('berat');
      $this->db->where('id_sampah', $id_sampah);
      $result = $this->db->get('tb_detail_setoran')->row();
      return $result->berat;
    }
    public function getUniqueSampahIds()
    {
      $this->db->select('id_sampah');
      $result = $this->db->get('tb_detail_setoran')->result();
      $sampah_ids = array();
      foreach ($result as $row) {
          $sampah_ids[] = $row->id_sampah;
      }
      return $sampah_ids;
    }
    
    public function tampil_barangkeluar()
    {
      $this->db->select('tb_barangkeluar.*, jns_sampah.nama_sampah');
      $this->db->from('tb_barangkeluar');
      $this->db->join('jns_sampah', 'tb_barangkeluar.id_sampah = jns_sampah.id_sampah', 'left');
      
      // Lakukan pengambilan data atau operasi lainnya jika diperlukan
      $result = $this->db->get()->result();
      
      return $result;
      
    }

  }