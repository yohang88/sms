<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reminders extends CI_Model {

    public function getList($offset=0, $limit=20, $search="")
    {
        $sql = "
            SELECT *
            FROM sms_reminders ";

        if(!empty($search)) {
            $sql .= " WHERE (name LIKE '%".$search."%' OR receiver LIKE '%".$search."%') AND DATE(datedue) >= DATE(NOW())";
        } else {
            $sql .= " WHERE DATE(datedue) >= DATE(NOW()) ";
        }

        $sql .=  "ORDER BY datedue ASC
                  LIMIT ".$offset.",".$limit."
        ";

        $query = $this->db->query($sql);

        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getTotal($search="")
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM sms_reminders
        ";

        if(!empty($search)) {
            $sql .= " WHERE (name LIKE '%".$search."%' OR receiver LIKE '%".$search."%') AND DATE(datedue) >= DATE(NOW())";
        } else {
            $sql .= " WHERE DATE(datedue) >= DATE(NOW()) ";
        }

        $query = $this->db->query($sql);

        return $query->row()->total;
    }

    public function getDetail($id)
    {
        $sql = "
            SELECT *
            FROM sms_reminders
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
		$this->db->insert('sms_reminders', array('id' => NULL) );
		$id = $this->db->insert_id();
		return $this->edit($id, $data);
	}

	function edit($id, $data) {
		$this->db->where('id', $id);
		$result = $this->db->update('sms_reminders', $data);

		if($result) {
			return $id;
		} else {
			return false;
		}
	}

	function delete($id) {
		$result = $this->db->delete('sms_reminders', array('id' => $id));

		if($result) {
			return true;
		} else {
			return false;
		}
	}

    function importCSV($data)
    {
        return $this->db->replace_into('sms_reminders', $data);
    }

    public function cronGetReminders()
    {
        $sql = "
            SELECT *
            FROM sms_reminders
            WHERE DATE(datedue) = DATE(NOW())
        ";

        $query = $this->db->query($sql);

        return $query;
    }
}
