<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orders extends Migration
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
            'customer_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'customer_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
            ],
            'payment_method' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'null' => FALSE,
                'default' => '1'
            ],
            'shipping_to' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
            ],
            'total' => [
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
            'created_at DATETIME NOT NULL DEFAULT current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('customer_id', 'customer', 'id');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('orders', TRUE, $attributes);
    }

    //Run command on cmd: php spark migrate:rollback to remove table.
    public function down()
    {
        $this->forge->dropTable('orders', TRUE);
    }
}
