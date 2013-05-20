<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scheduled extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->user->on_invalid_session('auth');
    }

	public function index($offset=0)
	{
        $this->load->library('pagination');

        $per_page             = $this->config->item('pagination_page_limit');
        $messages             = $this->message->listMessage('scheduled', false, $offset, $per_page);
        $message_total        = (int) $this->message->listMessage('scheduled', true);

        $config['base_url']   = site_url('scheduled/index');
        $config['total_rows'] = $message_total;
        $config['per_page']   = $per_page;

        $this->pagination->initialize($config);

        $data['messages']     = $messages;
        $data['type']         = 'scheduled';

		$this->load->view('common/header');
		$this->load->view('scheduled/index', $data);
		$this->load->view('common/footer');
	}
}
