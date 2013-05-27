<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends CI_Model {

    private function buildSelect()
    {
        $sql = " SELECT * FROM sms_templates ";
        return $sql;
    }

    private function buildWhere($id)
    {
        $sql = " WHERE ";
        $sql .= " id = " . $id;
        return $sql;
    }

    private function buildOrder($field='id', $sort='ASC')
    {
        $sql = " ORDER BY " . $field . " " . $sort;
        return $sql;
    }

    private function buildLimit($offset=0, $limit=20)
    {
        $sql = " LIMIT " . $offset . "," . $limit;
        return $sql;
    }

    private function buildQuery()
    {
        $sql = "";
        $sql .= $this->buildSelect();
        $sql .= $this->buildOrder('title');
        $sql .= $this->buildLimit();

        $query = $this->db->query($sql);

        return $query;
    }

    public function getItems()
    {
        $query = $this->buildQuery();

        if($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function getItem($id)
    {
        $query = $this->buildQuery();

        if($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }


    public function add($data)
    {
        $this->db->insert('sms_templates', array('id' => NULL) );
        $id = $this->db->insert_id();
        return $this->edit($id, $data);
    }

    public function edit($id, $data)
    {
        $this->db->where('id', $id);

        $result = $this->db->update('sms_templates', $data);

        if($result) {
            return $id;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $result = $this->db->delete('sms_templates', array('id' => $id));
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getList($offset=0, $limit=20, $search="")
    {
        $sql = "";
        $sql .= "
            SELECT *
            FROM sms_templates";

        if(!empty($search)) {
            $sql .= " WHERE content LIKE '%".$search."%' ";
        }

        $sql .= " ORDER BY title ASC
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
            FROM sms_templates
        ";

        if(!empty($search)) {
            $sql .= " WHERE content LIKE '%".$search."%' ";
        }

        $query = $this->db->query($sql);

        return $query->row()->total;
    }

    public function getDetail($id)
    {
        $sql = "
            SELECT *
            FROM sms_templates
            WHERE `id` = ".$id."
        ";

        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
}
