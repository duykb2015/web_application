<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Admin extends Seeder
{
    public function run()
    { {
            //Seed data
            $data[] = [
                'username' => 'admin',
                'password'  => md5('1112'),
                'level' => '0',
            ];
            //Seed data
            $data[] = [
                'username' => 'kieu',
                'password'  => md5('kieu'),
                'level' => '1',
            ];
            //Seed data
            $data[] = [
                'username' => 'luan',
                'password'  => md5('luan'),
                'level' => '1',
            ];
            //Seed data
            $data[] = [
                'username' => 'binh',
                'password'  => md5('binh'),
                'level' => '1',
            ];

            $this->db->transBegin();
            // Using Query Builder
            for ($i = 0; $i < 4; $i++) {
                $is_save = $this->db->table('admin')->insert($data[$i]);
                if (!$is_save) {
                    $this->db->transRollback();
                    throw new \Exception($this->db->error()['message']);
                }
            }
            $this->db->transCommit();
        }
    }
}
