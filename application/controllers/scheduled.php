<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scheduled extends CI_Controller {

	public function index()
	{
        $data['messages'] = $this->message->listMessage('scheduled');
        $data['type'] = 'scheduled';
        
		$this->load->view('common/header');
		$this->load->view('scheduled/index', $data);
		$this->load->view('common/footer');
	}
}
