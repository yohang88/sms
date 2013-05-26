<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_UpdateDB extends CI_Migration {

    public function up()
    {
        // Config Table
        $this->dbforge->add_field(array(
            'key' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
                ),
            'params' => array(
                'type' => 'TEXT',
                'null' => TRUE
                )
            ));
        $this->dbforge->add_key('key', TRUE);
        $this->dbforge->create_table('config');

        $data = array(
         array(
          'key' => 'sms_signature',
          'params' => 'mySMS Center'
          ),
         array(
          'key' => 'sms_signature_enable',
          'params' => '0'
          )
         );

        $this->db->insert_batch('config', $data);

        // User Flag in SMS Log table
        $fields = array(
            'flag' => array(
                'type' => 'VARCHAR',
                'constraint' => '1',
                'null' => TRUE
                )
            );
        $this->dbforge->add_column('log', $fields);

    }

    public function down()
    {
        $this->dbforge->drop_table('config');
        $this->dbforge->drop_column('log', 'flag');
    }

}