<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

   public function __construct()
   {
        parent::__construct();
        $this->user->on_invalid_session('auth');
   }

	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('home/index');
		$this->load->view('common/footer');
	}
}
