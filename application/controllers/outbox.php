<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Outbox extends CI_Controller {

	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('outbox/index');
		$this->load->view('common/footer');
	}
}
