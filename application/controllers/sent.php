<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sent extends CI_Controller {

	public function index()
	{
        $data['messages'] = $this->message->listMessage('sent');        
        $data['type'] = 'sent';
        
		$this->load->view('common/header');
		$this->load->view('sent/index', $data);
		$this->load->view('common/footer');
	}
}
