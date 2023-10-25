<?php
Class CekLogin {
    protected $ci;
    function __construct(){
        $this->ci =& get_instance();
    }

    function cek_role()
    {
        $this->ci->load->model('m_user');
        $user_id = $this->ci->session->userdata('id_user');
        $user_data = $this->ci->m_user->get_role_by_id($user_id);
        return $user_data;
    }
}
?>
