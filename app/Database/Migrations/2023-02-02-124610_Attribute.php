<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Attribute extends Migration
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
            'name' => [
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
        ]);
        $this->forge->addPrimaryKey('id');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('attribute', TRUE, $attributes);
    }

    //Run command on cmd: php spark migrate:rollback to remove table.
    public function down()
    {
        $this->forge->dropTable('attribute', TRUE);
    }
}
