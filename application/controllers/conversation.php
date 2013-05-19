<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Conversation extends CI_Controller {

   public function __construct()
   {
        parent::__construct();
        $this->user->on_invalid_session('auth');
   }

	public function index()
	{
        redirect('inbox');
	}

    public function view($with)
    {
        $data['messages'] = $this->message->listConversation($with);

        $this->load->view('common/header');
        $this->load->view('conversation/view', $data);
        $this->load->view('common/footer');
    }
}
