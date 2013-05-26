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

    public function view($with, $offset=0)
    {
        $this->load->library('pagination');

        $per_page              = $this->config->item('conversation_page_limit');
        $messages              = $this->message->listConversation($with, false, $offset, $per_page);
        $message_total         = (int) $this->message->listConversation($with, true);

        $config['base_url']    = site_url('conversation/view/'.$with);
        $config['uri_segment'] = 4;
        $config['total_rows']  = $message_total;
        $config['per_page']    = $per_page;

        $this->pagination->initialize($config);

        $data['with_number'] = $with;
        $data['messages']    = $messages;

        $this->session->set_flashdata('return_url', current_url());

        $this->load->view('common/header');
        $this->load->view('conversation/view', $data);
        $this->load->view('common/footer');
    }
}
