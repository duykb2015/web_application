<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class OrdersProduct extends Migration
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
            'orders_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'discount' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'option' => [
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
        $this->forge->addForeignKey('orders_id', 'orders', 'id');
        $this->forge->addForeignKey('product_id', 'product', 'id');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('orders_product', TRUE, $attributes);
    }

    //Run command on cmd: php spark migrate:rollback to remove table.
    public function down()
    {
        $this->forge->dropTable('orders_product', TRUE);
    }
}
