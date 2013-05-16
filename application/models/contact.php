<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Model {

    public function getList()
    {
    
    }
    
    public function getDetail($number)
    {
        $sql = "
            SELECT *
            FROM sms_contacts
            WHERE `primary` = '".$number."'
        ";
        
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return $query->row();
        } else {
            $unknown_number = new stdClass;
            $unknown_number->name = $number;
            return $unknown_number;
        }
    }
}
