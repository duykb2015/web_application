<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Product extends Migration
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
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'discount' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'total_sold' => [
                'type' => 'INT',
                'constraint' => 11,
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
        $this->forge->createTable('product', TRUE, $attributes);
    }

    //Run command on cmd: php spark migrate:rollback to remove table.
    public function down()
    {
        $this->forge->dropTable('product', TRUE);
    }
}
