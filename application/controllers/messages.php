<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {

   public function __construct()
   {
        parent::__construct();
        $this->user->on_invalid_session('auth');
   }

	public function compose($target="")
	{
        $target_json = array();

        if(!empty($target)) {
            $target_name   = $this->contact->getDetail($target);
            if($target_name) {
                $target_json[] = array('id' => $target, 'name' => $target_name->name);
            } else {
                $target_json[] = array('id' => $target, 'name' => $target);
            }
        }

        $data['target_json'] = json_encode($target_json);

        $templates = $this->templates->getItems();

        array_unshift($templates, (object) array("id" => 0, "title" => "Pilih salah satu...", "content" => ""));

        foreach($templates as $template) {
            $data['templates'][$template->id] = $template->title;
            $data['js_templates'][$template->id] = $template->content;
        }

		$this->load->view('common/header');
		$this->load->view('messages/compose', $data);
		$this->load->view('common/footer');
	}

    public function send()
    {
        $sendoption = $this->input->post('sendoption');
        $text       = $this->input->post('text');
        $date       = $this->input->post('date');
        $hour       = $this->input->post('hour');
        $minute     = $this->input->post('minute');

        $datetime = "";
        if(!empty($date))
            $datetime = $date . ' ' . implode(':', array($hour, $minute, '00'));

        switch ($sendoption) {
            case 'sendoption1':
                $this->form_validation->set_rules('number', 'Nomor Telepon', 'trim|required');
                $numbers = $this->input->post('number');

                if ($this->form_validation->run() == FALSE){
                    return $this->compose();
                }

                $numbers = explode(',', $numbers);

                foreach($numbers as $number) {
                    if(substr($number,0,1) == 'g') {
                        $group_id = substr($number,1);
                        $memberlist = $this->contactgroup->getMemberList($group_id);
                        foreach($memberlist as $member) {
                            $this->message->sendsms($member->primary, $text, $datetime);
                        }
                    } else {
                        $result = $this->message->sendsms($number, $text, $datetime);
                    }
                }

                break;

            case 'sendoption2':
                $this->form_validation->set_rules('manualvalue', 'Nomor Telepon Manual', 'trim|required');
                $numbers = $this->input->post('manualvalue');

                if ($this->form_validation->run() == FALSE){
                    return $this->compose();
                }

                $numbers = explode(',', $numbers);

                foreach($numbers as $number) {
                    $result = $this->message->sendsms(trim($number), $text, $datetime);
                    if(!$result) {
                        break;
                    }
                }

                break;

            case 'sendoption3':
                $config['upload_path']   = './uploads/';
                $config['allowed_types'] = 'csv';
                $config['encrypt_name']  = true;

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

                    ini_set('auto_detect_line_endings',TRUE);
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
                }

                $numbers = $csv["Number"];
                $numbers = explode(',', $numbers);

                foreach($numbers as $number) {
                    $result = $this->message->sendsms(trim($number), $text, $datetime);
                    if(!$result) {
                        break;
                    }
                }

                break;

            default:
                redirect('messages/compose');
                break;
        }

        if($result) {
            $this->session->set_flashdata('notif_type', 'success');
            $this->session->set_flashdata('notif_text', 'Pesan berhasil masuk antrian kirim, silahkan lihat menu Antrian Kirim.');
        } else {
            $this->session->set_flashdata('notif_type', 'error');
            $this->session->set_flashdata('notif_text', 'Pesan gagal masuk antrian kirim');
        }

        redirect('messages/compose');
    }


    public function delete($sms_id)
    {
        $return_url = $this->session->flashdata('return_url');
        $result = $this->message->delete($sms_id);

        if($result) {
            $this->session->set_flashdata('notif_type', 'success');
            $this->session->set_flashdata('notif_text', 'Pesan berhasil dihapus');
        } else {
            $this->session->set_flashdata('notif_type', 'error');
            $this->session->set_flashdata('notif_text', 'Pesan gagal dihapus');
        }

        redirect($return_url);
    }

    public function getMessageCount()
    {
        $this->session->keep_flashdata('return_url');

        $count                = array();
        $count['unresponded'] = $this->message->getUnrespondedContactCount();
        $count['outbox']      = $this->message->getOutgoingCount();
        $count['failed']      = $this->message->getFailedCount();
        $count['scheduled']   = $this->message->getScheduledCount();
        header('Content-type: application/json');
        echo json_encode($count);
    }

}
