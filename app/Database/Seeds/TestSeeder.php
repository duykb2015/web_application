<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        $this->call('Admin');
        $this->call('Attribute');
        $this->call('Category');
    }
}
