<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Failed extends CI_Controller {

   public function __construct()
   {
        parent::__construct();
        $this->user->on_invalid_session('auth');
   }

	public function index()
	{
        $data['messages'] = $this->message->listMessage('failed');
        $data['type'] = 'failed';

		$this->load->view('common/header');
		$this->load->view('failed/index', $data);
		$this->load->view('common/footer');
	}
}
