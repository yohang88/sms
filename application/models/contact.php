<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Model {

    public function getList($offset=0, $limit=20)
    {
        $sql = "
            SELECT *
            FROM sms_contacts
            ORDER BY name ASC
            LIMIT ".$offset.",".$limit."
        ";

        $query = $this->db->query($sql);

        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getTotal()
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM sms_contacts
        ";

        $query = $this->db->query($sql);

        return $query->row()->total;
    }

    public function ajaxListSearch($query)
    {
        $sql = "
            SELECT `primary` as id, name
            FROM sms_contacts
            WHERE name LIKE '%".$query."%'
            ORDER BY name ASC
        ";

        $query = $this->db->query($sql);

        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ajaxListGroupSearch($query)
    {
        $sql = "
            SELECT CONCAT('g',id) AS id, name
            FROM sms_groups
            WHERE name LIKE '%".$query."%'
            ORDER BY name ASC
        ";

        $query = $this->db->query($sql);

        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getDetail($number)
    {
        $sql = "
            SELECT *
            FROM sms_contacts
            WHERE `primary` = '".$number."' || `id` = '".$number."'
        ";

        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

	function add($data) {
		$this->db->insert('sms_contacts', array('id' => NULL) );
		$id = $this->db->insert_id();
		return $this->edit($id, $data);
	}

	function edit($id, $data) {
		$this->db->where('id', $id);
		$result = $this->db->update('sms_contacts', $data);
        $update_group = $this->updateGroup($id, $data);

		if($result) {
			return $id;
		} else {
			return false;
		}
	}

	function delete($id) {
		$result = $this->db->delete('sms_contacts', array('id' => $id));
        if($result){
            return true;
        } else {
            return false;
        }
	}

    function updateGroup($id, $data)
    {
        $delete_membership = $this->db->delete('sms_contactgroup', array('id_contact' => $id));
        $groups            = $data['group'];
        $groups            = explode(',', $groups);

        if(!empty($groups[0])) {
            foreach($groups as $group) {
                $this->db->insert('sms_contactgroup', array('id_group' => $group, 'id_contact' => $id) );
            }
        }
    }
}
