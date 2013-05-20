<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sent extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->user->on_invalid_session('auth');
    }

	public function index($offset=0)
	{
        $this->load->library('pagination');

        $per_page             = $this->config->item('pagination_page_limit');;
        $messages             = $this->message->listMessage('sent', false, $offset, $per_page);
        $message_total        = (int) $this->message->listMessage('sent', true);

        $config['base_url']   = site_url('sent/index');
        $config['total_rows'] = $message_total;
        $config['per_page']   = $per_page;

        $this->pagination->initialize($config);

        $data['messages']     = $messages;
        $data['type']         = 'sent';

		$this->load->view('common/header');
		$this->load->view('sent/index', $data);
		$this->load->view('common/footer');
	}
}
