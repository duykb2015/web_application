<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductCartOption extends Migration
{
   //Run command on cmd: php spark migrate to import table.
   public function up()
   {
       $this->forge->addField([
           'cart_id' => [
               'type' => 'INT',
               'constraint' => 11,
               'null' => FALSE,
               'auto_increment' => TRUE,
           ],
           'product_attribute_id' => [
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
       $this->forge->createTable('product_cart_option', TRUE, $attributes);
   }

   //Run command on cmd: php spark migrate:rollback to remove table.
   public function down()
   {
       $this->forge->dropTable('product_cart_option', TRUE);
   }
}
