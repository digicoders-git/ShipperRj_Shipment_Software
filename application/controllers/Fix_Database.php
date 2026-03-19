<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fix_Database extends CI_Controller
{

    public function create_table()
    {
        $this->load->dbforge();

        // Drop table if exists to start clean (optional, but safer here since it's "not existing")
        // $this->dbforge->drop_table('contact_inquiry', TRUE);

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'mobile' => array(
                'type' => 'VARCHAR',
                'constraint' => '15',
                'null' => TRUE,
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'message' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('contact_inquiry', TRUE)) {
            echo "SUCCESS: Table 'contact_inquiry' created successfully!";
        } else {
            echo "ERROR: Failed to create table.";
        }
    }
}
