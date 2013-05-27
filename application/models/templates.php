<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends CI_Model {

    private function buildSelect()
    {
        $sql = " SELECT * FROM sms_templates ";
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
        $sql .= $this->buildOrder();
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

    public function delete($id)
    {
        $result = $this->db->delete('sms_log', array('id' => $id));
        if($result) {
            return true;
        } else {
            return false;
        }
    }
}
