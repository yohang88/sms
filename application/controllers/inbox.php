<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inbox extends CI_Controller {

	public function index()
	{
        $data['messages'] = $this->message->listMessage('received');
        $data['type'] = 'received';
        
		$this->load->view('common/header');
		$this->load->view('inbox/index', $data);
		$this->load->view('common/footer');
	}
}
