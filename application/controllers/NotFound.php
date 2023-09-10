<?php
class NotFound extends CI_Controller {
	
	public function index()
	{
		$this->load->view('error/404');
	}
}
