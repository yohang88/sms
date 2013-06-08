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
                // var_dump($item);
                $result = $this->message->sendsms(trim($item->receiver), "Ini adalah reminder");
            }
        }
   }

}
