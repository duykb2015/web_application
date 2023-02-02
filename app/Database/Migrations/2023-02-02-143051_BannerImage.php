<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BannerImage extends Migration
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
            'banner_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'link' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE,
                'auto_increment' => TRUE,
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('banner_id', 'banner', 'id');
        $attributes = [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ];
        $this->forge->createTable('banner_image', TRUE, $attributes);
    }

    //Run command on cmd: php spark migrate:rollback to remove table.
    public function down()
    {
        $this->forge->dropTable('banner_image', TRUE);
    }
}
