<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function sendReminders()
    {
        $query = $this->reminders->cronGetReminders();

        if($query->num_rows() > 0) {
            $getList = $query->result();
            foreach($getList as $item) {
                $text = $this->templates->getItem(3);
                $text = str_replace(array('[Nama]', '[Tanggal]'), array($item->name, $item->datedue), $text->content);

                $result = $this->message->sendsms(trim($item->receiver), $text);
                if($result) {
                    $data = array('flag' => 'S');
                    $this->db->where('id', $item->id);
                    $this->db->update('reminders', $data);
                }
            }
        }
    }
}
