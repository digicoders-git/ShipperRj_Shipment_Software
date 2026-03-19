<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_Fix extends CI_Controller
{
    public function index()
    {
        $this->load->dbforge();

        if (!$this->db->table_exists('tbl_delivery_options')) {
            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'standard_price' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
                ),
                'express_price' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
                ),
                'overnight_price' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                    'null' => TRUE,
                )
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            if ($this->dbforge->create_table('tbl_delivery_options')) {
                echo "Table tbl_delivery_options created successfully!<br>";
                // Insert some default values
                $data = array(
                    'standard_price' => '50',
                    'express_price' => '150',
                    'overnight_price' => '250'
                );
                $this->db->insert('tbl_delivery_options', $data);
                echo "Default prices inserted.";
            } else {
                echo "Failed to create table.";
            }
        } else {
            echo "Table tbl_delivery_options already exists.";
        }
    }
}
