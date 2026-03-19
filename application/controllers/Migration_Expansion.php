<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Expansion extends CI_Controller
{

    public function up()
    {
        $this->load->dbforge();

        // 1. Create weight_slots table
        $this->dbforge->add_field(array(
            'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
            'slot_name' => array('type' => 'VARCHAR', 'constraint' => '255'),
            'min_weight' => array('type' => 'DECIMAL', 'constraint' => '10,2'),
            'max_weight' => array('type' => 'DECIMAL', 'constraint' => '10,2'),
            'created_at' => array('type' => 'TIMESTAMP', 'null' => TRUE),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('weight_slots', TRUE);

        // 2. Add weight_slot_id to price table
        $fields = array(
            'weight_slot_id' => array('type' => 'INT', 'constraint' => 11, 'null' => TRUE, 'after' => 'to_pin')
        );
        $this->dbforge->add_column('price', $fields);

        // 3. Create disputes table
        $this->dbforge->add_field(array(
            'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
            'user_id' => array('type' => 'INT', 'constraint' => 11),
            'booking_id' => array('type' => 'INT', 'constraint' => 11),
            'dispute_type' => array('type' => 'VARCHAR', 'constraint' => '100'),
            'description' => array('type' => 'TEXT'),
            'evidence' => array('type' => 'TEXT', 'null' => TRUE), // JSON field for multiple files
            'status' => array('type' => 'ENUM("Pending", "Resolved")', 'default' => 'Pending'),
            'admin_remark' => array('type' => 'TEXT', 'null' => TRUE),
            'created_at' => array('type' => 'TIMESTAMP', 'null' => TRUE),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('disputes', TRUE);

        // 4. Create wallet_notifications table
        $this->dbforge->add_field(array(
            'id' => array('type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE),
            'user_id' => array('type' => 'INT', 'constraint' => 11),
            'type' => array('type' => 'ENUM("Credit", "Debit")'),
            'amount' => array('type' => 'DECIMAL', 'constraint' => '10,2'),
            'reason' => array('type' => 'TEXT'),
            'created_at' => array('type' => 'TIMESTAMP', 'null' => TRUE),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('wallet_notifications', TRUE);

        echo "SUCCESS: Migration Expansion completed!";
    }
}
