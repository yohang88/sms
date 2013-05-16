<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addressbook extends CI_Controller {

	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('addressbook/index');
		$this->load->view('common/footer');
	}

}
