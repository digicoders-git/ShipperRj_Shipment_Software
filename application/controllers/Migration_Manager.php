<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Manager extends CI_Controller
{
    public function up()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `managers` (
            `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `mobile` VARCHAR(20) NOT NULL,
            `address` TEXT NULL,
            `aadhar_number` VARCHAR(20) NULL,
            `status` ENUM('true', 'false') NOT NULL DEFAULT 'true',
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

        if ($this->db->query($sql)) {
            echo "SUCCESS: Managers table created!";
        } else {
            echo "ERROR: Failed to create managers table.";
        }
    }
}
