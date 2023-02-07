<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Category extends Seeder
{
    public function run()
    {
        //Seed data
        $json = file_get_contents(FCPATH . 'category.json');
        $datas = json_decode($json, true);
        // Using Query Builder
        foreach ($datas as $data) {
            $this->db->table('category')->insert($data);
        }
    }
}
