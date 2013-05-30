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
        $data['sms_signature_enable'] = $this->input->post('signature_active');
        $data['sms_signature']        = $this->input->post('signature');

        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if($this->upload->do_upload('file_logo'))
        {
            $logo_data = $this->upload->data();

            $data['logo_file'] = $logo_data["file_name"];
        }

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

    public function backupDB()
    {
        $this->load->dbutil();
        $backup =& $this->dbutil->backup();
        $this->load->helper('download');
        $datestamp = date("Y-m-d-His");
        $filename = "backupsms_" . $datestamp . ".sql.gz";
        force_download($filename, $backup);

        return true;
    }
}
