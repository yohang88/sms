<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CommonMessage extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->user->on_invalid_session('auth');
    }

    public function delete($sms_id)
    {
        $return_url = $this->session->flashdata('referrer');
        $result = $this->message->delete($sms_id);

        if($result) {
            $this->session->set_flashdata('notif_type', 'success');
            $this->session->set_flashdata('notif_text', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('notif_type', 'error');
            $this->session->set_flashdata('notif_text', 'Data gagal dihapus');
        }

        redirect($return_url);
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
