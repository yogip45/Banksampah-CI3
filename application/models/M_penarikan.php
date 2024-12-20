<?php
class M_penarikan extends CI_Model
{
  public function tampil_data()
  {
    $this->db->select('tb_penarikan.*');
    $this->db->from('tb_penarikan');
    return $this->db->get();
  }
  public function getPenarikanByMonth($tahun)
  {
    $query = $this->db->query("
          SELECT
              MONTH(tgl_penarikan) AS bulan,
              SUM(jumlah_penarikan) AS jumlah_penarikan
          FROM
              tb_penarikan
          WHERE
              YEAR(tgl_penarikan) = $tahun
          GROUP BY
              MONTH(tgl_penarikan)
          ORDER BY
              bulan
      ");
    return $query->result();
  }
  public function getPenarikanByDateRange($tglAwal, $tglAkhir)
  {
    $this->db->select('tb_penarikan.*, tb_nasabah.nama');
    $this->db->from('tb_penarikan');
    $this->db->join('tb_nasabah', 'tb_nasabah.nin = tb_penarikan.nin', 'inner');
    $this->db->where('tgl_penarikan >=', $tglAwal);
    $this->db->where('tgl_penarikan <=', date('Y-m-d 23:59:59', strtotime($tglAkhir)));
    $query = $this->db->get();
    return $query->result();
  }
  public function tampil_databyNin($nin)
  {
    $this->db->select('tb_penarikan.*');
    $this->db->from('tb_penarikan');
    $this->db->where('nin', $nin);
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
  public function ambil_saldo($jumlah_penarikan, $nin)
  {
    $this->db->where('nin', $nin);
    $this->db->set('saldo', 'saldo - ' . $jumlah_penarikan, FALSE);
    return $this->db->update('tb_nasabah');
  }
  public function konfirmasiPenarikan($id_penarikan)
  {
    $this->db->where('id_penarikan', $id_penarikan);
    return $this->db->update('tb_penarikan', array('status' => 1));
  }
  public function batalkanPenarikan($nin, $jumlah_penarikan, $id_penarikan)
  {
    $saldo_sebelumnya = $this->db->select('saldo')->where('nin', $nin)->get('tb_nasabah')->row()->saldo;
    $saldo_baru = $saldo_sebelumnya + $jumlah_penarikan;
    $this->db->where('nin', $nin);
    $this->db->update('tb_nasabah', array('saldo' => $saldo_baru));
    $this->db->where('id_penarikan', $id_penarikan);
    return $this->db->update('tb_penarikan', array('status' => 3));
  }
  public function get_jumlah_penarikan($id_penarikan)
  {
    $this->db->select('jumlah_penarikan');
    $this->db->where('id_penarikan', $id_penarikan);
    $query = $this->db->get('tb_penarikan');
    return $query->row_array()['jumlah_penarikan'];
  }
}
