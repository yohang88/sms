<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ContactGroup extends CI_Model {

    public function getList($offset=0, $limit=20)
    {
        $sql = "
            SELECT a.id, name, IFNULL((SELECT COUNT(*) FROM sms_contactgroup b WHERE b.id_group = a.id GROUP BY b.id_group),0) as membercount
            FROM sms_groups a
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

    public function getGroupCount()
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM sms_groups a
        ";

        $query = $this->db->query($sql);

        return $query->row()->total;
    }

    function getMemberList($group_id, $offset=0, $limit=20)
    {
        $sql = "
            SELECT b.id, b.name, b.primary
            FROM sms_contactgroup a
            JOIN sms_contacts b ON a.id_contact = b.id
            JOIN sms_groups c ON a.id_group = c.id
            WHERE a.id_group = ".$group_id."
            ORDER BY b.name ASC
            LIMIT ".$offset.",".$limit."
        ";

        $query = $this->db->query($sql);

        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getMemberCount($group_id)
    {
        $sql = "SELECT COUNT(*) AS total FROM sms_contactgroup WHERE id_group = ".$group_id;

        $query = $this->db->query($sql);

        return $query->row()->total;
    }

    public function ajaxListSearch($group, $query)
    {
        $sql = "
            SELECT id, name
            FROM sms_contacts
            WHERE name LIKE '%".$query."%'
            AND id NOT IN (SELECT id_contact FROM sms_contactgroup WHERE id_group = ".$group.")
            ORDER BY name ASC
        ";

        $query = $this->db->query($sql);

        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function getDetail($id)
    {
        $sql = "
            SELECT *
            FROM sms_groups
            WHERE `id` = '".$id."'
        ";

        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

	function add($data) {
		$this->db->insert('sms_groups', array('id' => NULL) );
		$id = $this->db->insert_id();
		return $this->edit($id, $data);
	}

	function edit($id, $data) {
		$this->db->where('id', $id);
		$result = $this->db->update('sms_groups', $data);
		if($result){
			return $id;
		} else {
			return false;
		}
	}

	function delete($id ){
		$this->db->delete('sms_groups', array('id' => $id));
	}

    function addmember($group_id, $user_id) {
        $result = $this->db->insert('sms_contactgroup', array('id_contact' => $user_id, 'id_group' => $group_id));
		if($result){
			return true;
		} else {
			return false;
		}
    }
}
