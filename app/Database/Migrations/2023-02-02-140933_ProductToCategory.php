<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductToCategory extends Migration
{
    //Run command on cmd: php spark migrate to import table.
    public function up()
    {
    }

    //Run command on cmd: php spark migrate:rollback to remove table.
    public function down()
    {
        $this->forge->dropTable('product_to_category', TRUE);
    }
}
