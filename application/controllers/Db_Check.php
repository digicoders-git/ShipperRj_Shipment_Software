<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_Check extends CI_Controller
{
    public function index()
    {
        echo "<h3>Tables:</h3>";
        $tables = $this->db->list_tables();
        foreach ($tables as $table) {
            echo $table . "<br>";
        }

        echo "<h3>Price Table Structure:</h3>";
        if ($this->db->table_exists('price')) {
            $fields = $this->db->list_fields('price');
            foreach ($fields as $field) {
                echo $field . "<br>";
            }
        } else {
            echo "Price table does not exist.";
        }
    }
}
