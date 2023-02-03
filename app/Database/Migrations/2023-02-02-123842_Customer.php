<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customer extends Migration
{
    //Run command on cmd: php spark migrate to import table.
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'firstname' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'lastname' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'telephone' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'address1' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'address2' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            ],
            'last_login_at DATETIME NOT NULL DEFAULT current_timestamp'
        ]);
        $this->forge->addPrimaryKey('id');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('customer', TRUE, $attributes);
    }

    //Run command on cmd: php spark migrate:rollback to remove table.
    public function down()
    {
        $this->forge->dropTable('customer', TRUE);
    }
}
