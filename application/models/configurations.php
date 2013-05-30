<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configurations extends CI_Model {

    function getConfig($key="")
    {
        $sql = "
            SELECT *
            FROM sms_config";

        if(!empty($key)) {
            $sql .= " WHERE `key` = '".$key."'";
        }

        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            if(empty($key)) {
                $items = $query->result();

                foreach($items as $item) {
                    $data[$item->key] = $item->params;
                }

                return (object) $data;
            } else {
                return $query->row()->params;
            }
        } else {
            return false;
        }
    }

	function save($data) {

        foreach($data as $config_key => $config_value) {
            $row = array('params' => $config_value);

            $this->db->where('key', $config_key);
    		$result = $this->db->update('sms_config', $row);

    		if(!$result)
    			return false;
        }

        return true;
	}
}
