<?php
function getAutoNumber($table, $field, $pref, $length, $where = "") {
  $ci = &get_instance();
      $query = "SELECT IFNULL(MAX(CONVERT(MID($field," . (strlen($pref) + 1) . "," . ($length - strlen($pref)) . "),UNSIGNED INTEGER)),0)+1 AS NOMOR
              FROM $table WHERE LEFT($field," . (strlen($pref)) . ")='$pref' $where";
      $result = $ci->db->query($query)->row();
      $zero="";
      $num = $length - strlen($pref) - strlen($result->NOMOR);
      for ($i = 0; $i < $num; $i++) {
          $zero = $zero . "0";
      }
      return $pref . $zero . $result->NOMOR;
  }

function getAutoSetoranId() {
  $ci = &get_instance();
  $table = 'tb_setoran';
  $field = 'id_setor';
  
  // Mendapatkan tahun dan bulan saat ini (misal: 202309)
  $tahunBulan = date('Ym');
  
  // Membentuk prefix "ST-" dan tahun bulan
  $prefix = 'ST' . $tahunBulan;

  // Query untuk mencari nilai maksimum
  $query = "SELECT IFNULL(MAX(CONVERT(SUBSTRING($field, " . (strlen($prefix) + 1) . "), UNSIGNED INTEGER)), 0) + 1 AS NOMOR
            FROM $table
            WHERE LEFT($field, " . (strlen($prefix)) . ") = '$prefix'";

  $result = $ci->db->query($query)->row();
  
  // Format nomor dengan leading zeros
  $nomor = str_pad($result->NOMOR, 5, '0', STR_PAD_LEFT);

  // Menggabungkan prefix, tahun bulan, dan nomor
  $id_setor = $prefix . $nomor;

  return $id_setor;
}

?>