<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Validation extends CI_Form_validation {

    public function __construct($rules = array())
    {
        parent::__construct($rules);
    }

    public function compare_with_stok($jumlah,$id_sampah)
    {
        $this->CI->load->model('m_stok');
        $stok_value = $this->CI->m_stok->get_jumlah_by_id_sampah($id_sampah);
        if ((int)$jumlah > $stok_value) {
            // $this->CI->form_validation->set_message('compare_with_stok', 'Jumlah melebihi stok yang tersedia.');
            return false;
        }
        return true;
    }
}
