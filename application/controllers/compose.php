<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compose extends CI_Controller {

	public function index()
	{       
		$this->load->view('common/header');
		$this->load->view('compose/index');
		$this->load->view('common/footer');
	}
    
    public function send()
    {
        $number = $this->input->post('number');
        $text = $this->input->post('text');
        
        $this->message->sendsms($number, $text);
        
        redirect('outbox');
    }
}
