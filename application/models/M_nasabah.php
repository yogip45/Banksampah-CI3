<?php
class M_nasabah extends CI_Model
{
  public function tampil_data()
  {
    $this->db->select('tb_nasabah.*, tb_user.username, tb_user.email, tb_user.last_login, tb_user.is_active, tb_user.dibuat_oleh');
    $this->db->from('tb_nasabah');
    $this->db->join('tb_user', 'tb_user.id_user = tb_nasabah.id_user', 'inner');
    return $this->db->get()->result();
  }
  public function totalKgSetoran($nin)
  {
    $this->db->select_sum('ds.berat');
    $this->db->from('tb_detail_setoran as ds');
    $this->db->join('tb_setoran as s', 'ds.id_setor = s.id_setor');
    $this->db->where('s.nin', $nin);

    $query = $this->db->get();

    $result = $query->row();

    return $result->berat;
  }
  public function totalRpSetoran($nin)
  {
    $this->db->select_sum('total');
    $this->db->where('nin', $nin);
    $query = $this->db->get('tb_setoran');
    $result = $query->row();

    return $result->total;
  }
  public function totalRpPenarikan($nin)
  {
    $this->db->select_sum('jumlah_penarikan');
    $this->db->where('nin', $nin);
    $query = $this->db->get('tb_penarikan');
    $result = $query->row();

    return $result->jumlah_penarikan;
  }
  public function getSetoranByMonth($tahun, $nin)
  {
    $query = $this->db->query("
    SELECT
        MONTH(tanggal_setor) AS bulan,
        SUM(total) AS jumlah_setoran
    FROM
        tb_setoran
    WHERE
        YEAR(tanggal_setor) = ? AND nin = ?
    GROUP BY
        MONTH(tanggal_setor)
    ORDER BY
        bulan", array($tahun, $nin));
    return $query->result();
  }
  public function getPenarikanByMonth($tahun, $nin)
  {
    $query = $this->db->query("
    SELECT
        MONTH(tgl_penarikan) AS bulan,
        SUM(jumlah_penarikan) AS jumlah_penarikan
    FROM
        tb_penarikan
    WHERE
        YEAR(tgl_penarikan) = ? AND nin = ?
    GROUP BY
        MONTH(tgl_penarikan)
    ORDER BY
        bulan", array($tahun, $nin));
    return $query->result();
  }
  public function getNamaByNin($nin)
  {
    $query = $this->db->get_where('tb_nasabah', array('nin' => $nin));
    return $query->row(); // Mengembalikan hasil query
  }

  public function input_data($data)
  {
    $this->db->insert('tb_nasabah', $data);
  }
  public function hapus_data($where, $table)
  {
    $this->db->where($where);
    $this->db->delete($table);
  }
  public function hapus_nasabah($id_user)
  {
    $this->db->where('id_user', $id_user);
    $this->db->where('saldo', 0);
    $query = $this->db->get('tb_nasabah');

    if ($query->num_rows() > 0) {
      $result = $query->result();
      $nin = $result[0]->nin;

      $this->db->where('nin', $nin);
      $query_setoran = $this->db->get('tb_setoran');
      $this->db->where('nin', $nin);
      $query_penarikan = $this->db->get('tb_penarikan');
      if ($query_setoran->num_rows() == 0 && $query_penarikan->num_rows() == 0) {
        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_nasabah');

        $this->db->where('id_user', $id_user);
        $this->db->delete('tb_user');

        return true;
      } else {
        return false; // Return false jika NIN memiliki riwayat transaksi
      }
    } else {
      return false; // Return false jika saldo bukan 0 atau nasabah tidak ditemukan
    }
  }
  public function edit_data($where, $table)
  {
    return $this->db->get_where($table, $where);
  }
  public function get_user_nasabah_data($id_user)
  {
    $this->db->select('*');
    $this->db->from('tb_user');
    $this->db->join('tb_nasabah', 'tb_nasabah.id_user = tb_user.id_user', 'inner');
    $this->db->where('tb_user.id_user', $id_user);

    return $this->db->get()->result();
  }

  public function cek_hapus($nasabah)
  {
    $showHapusAkun = true;
    if ($nasabah->saldo != 0) {
      $showHapusAkun = false;
    } elseif ($nasabah->saldo == 0) {
      $this->db->where('nin', $nasabah->nin);
      $query_setoran = $this->db->get('tb_setoran');
      $query_penarikan = $this->db->get('tb_penarikan');
      if ($query_setoran->num_rows() == 0 || $query_penarikan->num_rows() == 0) {
        $showHapusAkun = true;
      }
    } else {
      $showHapusAkun = false;
    }
    return $showHapusAkun;
  }


  public function get_kec_desa($id_kecamatan, $id_desa)
  {
  }
  public function update_data($where, $data, $table)
  {
    $this->db->where($where);
    $this->db->update($table, $data);
  }
  public function change_status($where, $data, $table)
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