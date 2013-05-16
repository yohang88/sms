<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Model {

	public function sendsms($number, $text)
	{
        $filename = date("siH");
        $filepath = PATHOUTGOING . DS . $filename;
        
        $data = "To: ".$number."\n";
        $data .= "\n\n" . $text . date("siH");
        
        if(write_file($filepath, $data))
        {
            $this->insertQueue($filename, $data);
        }
	}
    
    public function insertQueue($filename, $text)
    {
        $data = array(
           'filename' => $filename,
           'type' => 'QUEUE',
           'receiver' => '6285729402579',
           'text' => $text
        );

        $this->db->insert('sms_log', $data);     
    }
    
    public function listMessage($type) 
    {  
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
            JOIN (SELECT MAX(id) id FROM sms_log GROUP BY `".$group."`) t2
            ON t1.id = t2.id
            WHERE type = '".$type."'
            ORDER BY id DESC
        ";    
        
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
}
