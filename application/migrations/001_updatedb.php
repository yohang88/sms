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
                ),
            array(
                'key' => 'logo_file',
                'params' => 'null'
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


        // Template Table
        $this->dbforge->add_field('id');
        $this->dbforge->add_field(array(
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
                ),
            'content' => array(
                'type' => 'TEXT',
                'null' => TRUE
                )
            ));

        $this->dbforge->create_table('templates');

        $data = array(
            array(
                'title' => "Terimakasih Saran dan Kritik",
                'content' => "Terimakasih banyak atas saran dan kritik yang Anda berikan. Kami akan segera menindaklanjuti hal tersebut."
                ),
            array(
                'title' => "Pemberitahuan",
                'content' => "Dengan ini kami memberitahukan bahwa kami akan menyelenggarakan kegiatan [Nama Kegiatan] pada [Hari], [Tanggal] dan bertempat di [Lokasi]. Kami mengharapkan partisipasi dari Anda.\n\nTerimakasih banyak."
                ),
            array(
                'title' => "Template Reminder",
                'content' => "Yth. [Nama], Ini adalah pesan pengingat otomatis. Pembayaran Anda akan jatuh tempo pada [Tanggal]."
                )
            );

        $this->db->insert_batch('templates', $data);


        // Reminder Table
        $this->dbforge->add_field(array(
            'id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => TRUE,
                 'auto_increment' => TRUE
                ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '200'
                ),
            'receiver' => array(
                'type' => 'VARCHAR',
                'constraint' => '50'
                ),
            'datedue' => array(
                'type' => 'DATE'
                ),
            'flag' => array(
                'type' => 'VARCHAR',
                'constraint' => '1',
                'default' => 'U'
                )
            ));

        $this->dbforge->add_key('id');
        $this->dbforge->add_key('receiver', TRUE);
        $this->dbforge->add_key('datedue', TRUE);

        $this->dbforge->create_table('reminders');
    }

    public function down()
    {
        $this->dbforge->drop_table('config');
        $this->dbforge->drop_table('templates');
        $this->dbforge->drop_table('reminders');
        $this->dbforge->drop_column('log', 'flag');
    }

}