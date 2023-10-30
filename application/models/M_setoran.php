<?php
class M_setoran extends CI_Model
{
  public function tampil_data()
  {
    $this->db->select('tb_setoran.*');
    $this->db->from('tb_setoran');
    return $this->db->get();
  }
  public function getSetoranByMonth($tahun)
  {
    $query = $this->db->query("
          SELECT
              MONTH(tanggal_setor) AS bulan,
              SUM(total) AS jumlah_setoran
          FROM
              tb_setoran
          WHERE
              YEAR(tanggal_setor) = $tahun
          GROUP BY
              MONTH(tanggal_setor)
          ORDER BY
              bulan
      ");
    return $query->result();
  }
  public function getSetoranByDateRange($tglAwal, $tglAkhir)
  {
    $this->db->select('tb_setoran.*, tb_nasabah.nama');
    $this->db->from('tb_setoran');
    $this->db->join('tb_nasabah', 'tb_nasabah.nin = tb_setoran.nin', 'inner');
    $this->db->where('tanggal_setor >=', $tglAwal);
    $this->db->where('tanggal_setor <=', $tglAkhir);
    $this->db->order_by('tb_setoran.tanggal_setor', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function getBarangKeluarByDateRange($tglAwal, $tglAkhir)
  {
    $this->db->select('tb_barangkeluar.*, jns_sampah.nama_sampah');
    $this->db->from('tb_barangkeluar');
    $this->db->join('jns_sampah', 'tb_barangkeluar.id_sampah = jns_sampah.id_sampah', 'inner');
    $this->db->where('tgl_keluar >=', $tglAwal);
    $this->db->where('tgl_keluar <=', $tglAkhir);
    $this->db->order_by('tb_barangkeluar.tgl_keluar', 'ASC');
    $query = $this->db->get();
    return $query->result();
  }
  public function getDetailSetoranByDateRange($tglAwal, $tglAkhir)
  {
    $this->db->select('tb_detail_setoran.id_setor, tb_detail_setoran.berat, tb_detail_setoran.harga, tb_detail_setoran.total, jns_sampah.nama_sampah');
    $this->db->from('tb_detail_setoran');
    $this->db->join('jns_sampah', 'jns_sampah.id_sampah = tb_detail_setoran.id_sampah', 'inner');
    $this->db->where('tanggal >=', $tglAwal);
    $this->db->where('tanggal <=', $tglAkhir);
    $query = $this->db->get();
    return $query->result();
  }
  public function getTahun()
  {
    $this->db->distinct();
    $this->db->select("YEAR(tanggal_setor) AS tahun");
    $this->db->from("tb_setoran");
    $query = $this->db->get();
    return $query->result();
  }
  public function tampil_databyNin($nin)
  {
    $this->db->where('nin', $nin);
    return $this->db->get('tb_setoran');
  }
  public function get_nasabah($id_setor)
  {
    $this->db->select('tb_setoran.*, tb_nasabah.nama, tb_nasabah.nin, tb_nasabah.saldo');
    $this->db->from('tb_setoran');
    $this->db->join('tb_nasabah', 'tb_setoran.nin = tb_nasabah.nin', 'left');
    $this->db->where('tb_setoran.id_setor', $id_setor); // Tambahkan kondisi WHERE
    return $this->db->get()->row_array();
  }
  public function tampil_detail($id_setor)
  {
    $this->db->select('tb_detail_setoran.*, jns_sampah.nama_sampah');
    $this->db->from('tb_detail_setoran');
    $this->db->join('jns_sampah', 'tb_detail_setoran.id_sampah = jns_sampah.id_sampah', 'left');
    $this->db->where('tb_detail_setoran.id_setor', $id_setor);

    return $this->db->get();
  }
  public function input_setoran($data, $id_setor)
  {
    $this->db->insert('tb_setoran', $data);
    $this->session->set_flashdata('sukses', 'Berhasil Ditambahkan');
    redirect('/index.php/setoran/detail_setoran/' . $id_setor);
  }
  public function input_detail($data, $id_setor)
  {
    $this->db->insert('tb_detail_setoran', $data);
    $this->session->set_flashdata('sukses', 'Berhasil Ditambahkan');
    redirect('/index.php/setoran/detail_setoran/' . $id_setor);

    // return true;
  }
  public function selesaiTransaksi($id_setor, $new_status, $total, $nin)
  {
    $data = array(
      'status' => $new_status,
      'total' => $total // Memperbarui kolom 'total' juga
    );
    $this->db->where('id_setor', $id_setor);
    return $this->db->update('tb_setoran', $data);
  }

  public function hapus_setoran($id_setor)
  {
    $this->db->where('id_setor', $id_setor);
    $detail_exists = $this->db->get('tb_detail_setoran')->num_rows() > 0;
    if ($detail_exists) {
      return false;
    } else {
      $this->db->where('status', 0);
      $this->db->delete('tb_setoran');
      return true;
    }
  }
  public function hapus_detail($id_detail_setoran)
  {
    $this->db->where('id', $id_detail_setoran);
    return $this->db->delete('tb_detail_setoran');
  }

  public function updateSaldo($nin, $total)
  {
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
    $this->db->where('nin', $keyword);
    $query_setoran = $this->db->get('tb_setoran');
    $this->db->where('nin', $keyword);
    $query_penarikan = $this->db->get('tb_penarikan');

    $result_setoran = $query_setoran->result();
    $result_penarikan = $query_penarikan->result();

    return array('setoran' => $result_setoran, 'penarikan' => $result_penarikan);
  }
}
