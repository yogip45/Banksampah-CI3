<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gagal extends CI_Controller {
	public function forbidden()
	{
		$this->load->view('error/403');
	}
}
