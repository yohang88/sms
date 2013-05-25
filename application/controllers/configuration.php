<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuration extends CI_Controller {

   public function __construct()
   {
        parent::__construct();
        $this->user->on_invalid_session('auth');
   }

	public function index()
	{
        $data['config'] = $this->configurations->getConfig();

		$this->load->view('common/header');
		$this->load->view('configuration/index', $data);
		$this->load->view('common/footer');
	}

    public function save()
    {
        $data = array();
        $data['sms_signature'] = $this->input->post('signature');

        $result = $this->configurations->save($data);

        if($result) {
            $this->session->set_flashdata('notif_type', 'success');
            $this->session->set_flashdata('notif_text', 'Konfigurasi berhasil disimpan');
        } else {
            $this->session->set_flashdata('notif_type', 'error');
            $this->session->set_flashdata('notif_text', 'Konfigurasi gagal disimpan');
        }

        redirect('configuration');
    }
}
