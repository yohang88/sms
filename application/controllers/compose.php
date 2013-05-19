<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compose extends CI_Controller {

   public function __construct()
   {
        parent::__construct();
        $this->user->on_invalid_session('auth');
   }

	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('compose/index');
		$this->load->view('common/footer');
	}

    public function send()
    {
        $this->form_validation->set_rules('number', 'Nomor Telepon', 'trim|required');
        if ($this->form_validation->run() == FALSE){
			return $this->index();
        }

        $numbers = $this->input->post('number');
        $numbers = explode(',', $numbers);

        $text = $this->input->post('text');

        foreach($numbers as $number) {
			if(substr($number,0,1) == 'g') {
				$group_id = substr($number,1);
				$memberlist = $this->contactgroup->getMemberList($group_id);
				foreach($memberlist as $member) {
					$this->message->sendsms($member->primary, $text);
				}
			} else {
				$this->message->sendsms($number, $text);
			}
        }

        redirect('outbox');
    }
}
