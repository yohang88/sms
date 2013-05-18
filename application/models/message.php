<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Model {

	public function sendsms($number, $text)
	{
        $filename = $this->generateRandomString(10);

        $filepath = PATHOUTGOING . DS . $filename;

        $data = "To: ".$number."\n";
        $data .= "\n\n" . $text;

        if(write_file($filepath, $data))
        {
            $this->insertQueue($filename, $number, $text);
        }
	}

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function insertQueue($filename, $number, $text)
    {
        $data = array(
           'filename' => $filename,
           'type' => 'QUEUE',
           'receiver' => $number,
           'text' => $text
        );

        $this->db->insert('sms_log', $data);
    }

    public function listMessage($type)
    {
        if($type == 'sent' || $type == 'received') {
            switch($type) {
                case 'sent':
                    $group = 'receiver';
                    break;

                case 'received':
                    $group = 'sender';
                    break;
            }

            $sql = "
                SELECT t1.* FROM sms_log t1
                JOIN (SELECT MAX(id) id FROM sms_log WHERE type = '".$type."' GROUP BY `".$group."`) t2
                ON t1.id = t2.id
                WHERE type = '".$type."'
                ORDER BY id DESC
            ";

        } elseif($type == 'queue' || $type == 'scheduled' || $type == 'failed') {
            $sql = "
                SELECT * FROM sms_log
                WHERE type = '".$type."'
                ORDER BY id DESC
            ";
        }

        /*
        $this->db->select('*');
        $this->db->from('sms_log');
        $this->db->where('type', $type);
        if($type == 'received')
            $this->db->group_by('sender');
        elseif($type == 'sent')
            $this->db->group_by('receiver');

        $this->db->limit(0, 20);
        */

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function listConversation($with)
    {
        $sql = "
            SELECT *
            FROM sms_log
            WHERE (`receiver` = '".$with."' OR `sender` = '".$with."') AND (`type` NOT IN ('SCHEDULED', 'QUEUE'))
            ORDER BY id DESC
            LIMIT 0,10
        ";

        $query = $this->db->query($sql);

        return $query->result();
    }
}
