<?php
  class M_setoran extends CI_Model
  {
    public function tampil_data()
    {      
      $this->db->select('tb_setoran.*');
      $this->db->from('tb_setoran');
      return $this->db->get();
    }
    public function tampil_databyNin($nin)
    {      
      $this->db->where('nin',$nin);
      return $this->db->get('tb_setoran');
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
    }
    public function input_detail($data,$id_setor)
    {
      $this->db->insert('tb_detail_setoran', $data);
      $this->session->set_flashdata('sukses','Berhasil Ditambahkan');
			redirect('/index.php/setoran/detail_setoran/'.$id_setor);
      
      // return true;
    }
    public function selesaiTransaksi($id_setor, $new_status, $total,$nin) 
    {
      $data = array(
          'status' => $new_status,
          'total' => $total // Memperbarui kolom 'total' juga
      );          
      $this->db->where('id_setor', $id_setor);
      return $this->db->update('tb_setoran', $data);
    }

    public function hapus_detail($id_detail_setoran)
    {
      $this->db->where('id', $id_detail_setoran);
      return $this->db->delete('tb_detail_setoran');
    }

    public function updateSaldo($nin,$total){
      // Mengupdate tabel tb_nasabah
      $this->db->where('nin', $nin);
      $saldo_sekarang = $this->db->get('tb_nasabah')->row()->saldo;
      $saldo_baru = $saldo_sekarang + $total;
      
      $data_nasabah = array(
          'saldo' => $saldo_baru
      );
      
      $this->db->where('nin', $nin);
      $this->db->update('tb_nasabah', $data_nasabah);
      }

    public function get_keyword($keyword)
    {
      $this->db->select('*');
      $this->db->from('tb_setoran');
      $this->db->like('nin', $keyword);

      return $this->db->get()->result();
    }


  }
?>