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
        $sendoption = $this->input->post('sendoption');
        $text       = $this->input->post('text');

        switch ($sendoption) {
            case 'sendoption1':
                $this->form_validation->set_rules('number', 'Nomor Telepon', 'trim|required');
                $numbers = $this->input->post('number');

                if ($this->form_validation->run() == FALSE){
                    return $this->index();
                }

                var_dump($numbers);
                exit;

                $numbers = explode(',', $numbers);

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

                break;

            case 'sendoption2':
                $this->form_validation->set_rules('manualvalue', 'Nomor Telepon Manual', 'trim|required');
                $numbers = $this->input->post('manualvalue');

                if ($this->form_validation->run() == FALSE){
                    return $this->index();
                }

                var_dump($numbers);
                exit;

                $numbers = explode(',', $numbers);

                foreach($numbers as $number) {
                    $this->message->sendsms(trim($number), $text);
                }

                break;

            case 'sendoption3':
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'csv';
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('import_file'))
                {
                    echo "error";
                }
                else
                {
                    $data = $this->upload->data();
                    $this->load->library('csvreader');
                    $filePath = $data["full_path"];

                    $csvData = $this->csvreader->parse_file($filePath, true);

                    $csvField = array_keys($csvData[0]);
                    foreach($csvData as $data)
                    {
                        foreach ($csvField as $field)
                        {
                            $tmp[$field][] = trim($data[$field]);
                        }
                    }
                    foreach ($csvField as $field)
                    {
                        $csv[$field] = implode(",", $tmp[$field]);
                    }
                    $csv['Field'] = $csvField;
                    echo json_encode($csv);
                    exit;
                }

                $numbers = "";
                break;

            default:
                redirect('compose');
                break;
        }

        redirect('outbox');
    }
}
