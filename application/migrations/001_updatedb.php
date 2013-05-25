<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_UpdateDB extends CI_Migration {

    public function up()
    {
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
        $this->dbforge->create_table('sms_config');
    }

    public function down()
    {
        $this->dbforge->drop_table('sms_config');
    }

}