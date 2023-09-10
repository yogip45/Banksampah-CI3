<?php
  class M_mhs extends CI_Model
  {
    public function get_data()
    {
      return $this->db->get('mhs')->result_array();
      
    }
  }
?>