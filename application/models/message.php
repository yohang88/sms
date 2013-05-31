<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Model {

	public function sendsms($number, $text, $schedule="")
	{
        $filename = generateRandomString(10);

        $filepath = PATHOUTGOING . DS . $filename;
        $data = "";

        $data .= "To: ".$number."\n";

        if(!empty($schedule)) {
            $filepath = PATHSCHEDULED . DS . $filename;
            $data .= "Send: ".$schedule."\n";
        }

        $data .= "\n" . $text;

        if(write_file($filepath, $data))
        {
            return $this->insertQueue($filename, $number, $text, $schedule);
        } else {
            return false;
        }
	}

    public function insertQueue($filename, $number, $text, $schedule="")
    {
        $data = array(
           'filename' => $filename,
           'type' => 'QUEUE',
           'receiver' => $number,
           'text' => $text
        );

        if(!empty($schedule)) {
            $data['sent'] = $schedule;
            $data['type'] = 'SCHEDULED';
        }

        return $this->db->insert('sms_log', $data);
    }

    public function listMessage($type, $counttotal, $offset=0, $limit=20)
    {

        $sql = "";

        if($type == 'sent' || $type == 'received') {
            switch($type) {
                case 'sent':
                    $group_by = 'receiver';
                    break;

                case 'received':
                    $group_by = 'sender';
                    break;
            }

            if($counttotal) {
                $sql .= " SELECT COUNT(*) AS total FROM sms_log t1 ";
            } else {
                $sql .= " SELECT t1.* FROM sms_log t1 ";
            }
            $sql .= " JOIN (SELECT MAX(id) id FROM sms_log WHERE type = '".$type."' GROUP BY `".$group_by."`) t2 ON t1.id = t2.id";
            $sql .= " WHERE type = '".$type."'";

            if(! $counttotal) {
                $sql .= " ORDER BY id DESC ";
            }

        } elseif($type == 'queue' || $type == 'scheduled' || $type == 'failed') {
            if(! $counttotal) {
                $sql .= " SELECT * FROM sms_log ";
            } else {
                $sql .= " SELECT COUNT(*) AS total FROM sms_log ";
            }

            $sql .= " WHERE type = '".$type."'";

            if(! $counttotal) {
                $sql .= " ORDER BY id DESC ";
            }
        }

        if(! $counttotal) {
            $sql .= " LIMIT ".$offset.",".$limit;
        }

        $query = $this->db->query($sql);

        if(! $counttotal) {
            return $query->result();
        } else {
            return $query->row()->total;
        }
    }

    public function listConversation($with, $counttotal, $offset=0, $limit=20)
    {
        $sql = "";
        if(! $counttotal) {
            $sql .= " SELECT * ";
        } else {
            $sql .= " SELECT COUNT(*) AS total ";
        }

        $sql .= " FROM sms_log
                  # WHERE (`receiver` = '".$with."' OR `sender` = '".$with."') AND (`type` NOT IN ('SCHEDULED', 'QUEUE', 'FAILED'))
                  WHERE (`receiver` = '".$with."' OR `sender` = '".$with."')
                ";

        if(! $counttotal) {
            $sql .= " ORDER BY id DESC LIMIT ".$offset.",".$limit;
        }

        $query = $this->db->query($sql);

        if(! $query)
            show_404();

        if(! $counttotal) {
            return $query->result();
        } else {
            return $query->row()->total;
        }
    }

    public function delete($id){
        $result = $this->db->delete('sms_log', array('id' => $id));
        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function setRespondedContact($number)
    {
        $this->db->where('sender', $number);
        $this->db->where('type', 'RECEIVED');

        $data['flag'] = 'R';

        $result = $this->db->update('sms_log', $data);

        if($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getUnrespondedContactCount()
    {
        $sql = " SELECT COUNT(*) AS total FROM sms_log WHERE `type` = 'RECEIVED' AND `flag` = 'U' GROUP BY sender ";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function isUnrespondedContact($number)
    {
        $sql = " SELECT COUNT(*) AS total FROM sms_log WHERE `type` = 'RECEIVED' AND `flag` = 'U' AND `sender` = '".$number."' ";
        $query = $this->db->query($sql);
        $total = $query->row()->total;

        if($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function isInboxHaveUnread($number)
    {
        $sql = " SELECT COUNT(*) AS total FROM sms_log WHERE `type` = 'RECEIVED' AND `flag` = 'U' AND `sender` = '".$number."'";
        $query = $this->db->query($sql);
        $total = $query->row()->total;

        if($total > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getInboxUnreadCount()
    {
        $sql = " SELECT COUNT(*) AS total FROM sms_log WHERE `type` = 'RECEIVED' AND `flag` = 'U' ";
        $query = $this->db->query($sql);
        return $query->row()->total;
    }

    public function getOutgoingCount()
    {
        $sql = " SELECT COUNT(*) AS total FROM sms_log WHERE `type` = 'OUTGOING' ";
        $query = $this->db->query($sql);
        return $query->row()->total;
    }

    public function getFailedCount()
    {
        $sql = " SELECT COUNT(*) AS total FROM sms_log WHERE `type` = 'FAILED' ";
        $query = $this->db->query($sql);
        return $query->row()->total;
    }

    public function getScheduledCount()
    {
        $sql = " SELECT COUNT(*) AS total FROM sms_log WHERE `type` = 'SCHEDULED' ";
        $query = $this->db->query($sql);
        return $query->row()->total;
    }

    public function getStatistic($type, $day)
    {
        $sql = " SELECT COUNT(*) AS total FROM sms_log WHERE `type` = '".$type."' AND DAY(sent) = ".$day." GROUP BY `TYPE`, DATE(sent) ";

        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            return $query->row()->total;
        } else {
            return 0;
        }
    }
}
