<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {

   public function __construct()
   {
        parent::__construct();
        $this->user->on_invalid_session('auth');
   }

	public function compose()
	{
		$this->load->view('common/header');
		$this->load->view('messages/compose');
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
        $return_url = $this->session->flashdata('referrer');
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
        $count           = array();
        $count['inbox']  = 6;
        $count['outbox'] = 72;
        $count['failed'] = 5;
        header('Content-type: application/json');
        echo json_encode($count);
    }

    public function statistic()
    {
        $this->load->library('OpenFlashChartLib', NULL, 'OFCL');
        $points = 10;
        $x = array(6);
        $yout = array(1);
        $yin = array(1);
        $data_1 = array(1,2,3,4);
        $data_2 = array(1,2,3,4);
        $data_3 = array(1,2,3,4);


        $bar_1 = new bar();
        $bar_1->set_values(50);
        $bar_1->set_colour('#639F45');
        $bar_1->key('incoming', 10 );

        $bar_2 = new bar();
        $bar_2->set_values(20);
        $bar_2->set_colour('#21759B');
        $bar_2->key('outgoing', 10 );

        $y = new y_axis();
        $y->set_range(0, 100, 10);

        $element1 = $bar_1;
        $element2 = $bar_2;

        $chart = new open_flash_chart();
        $chart->add_element($element1);
        $chart->add_element($element2);
        $chart->set_y_axis($y);


        echo $chart->toPrettyString();
    }
}
