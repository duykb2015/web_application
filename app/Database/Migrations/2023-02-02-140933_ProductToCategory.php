<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductToCategory extends Migration
{
    //Run command on cmd: php spark migrate to import table.
    public function up()
    {
        $this->forge->addField([
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
        ]);
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('product_to_category', TRUE, $attributes);
    }

    //Run command on cmd: php spark migrate:rollback to remove table.
    public function down()
    {
        $this->forge->dropTable('product_to_category', TRUE);
    }
}
