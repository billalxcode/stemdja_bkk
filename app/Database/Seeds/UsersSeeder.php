<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $table = $this->db->table('users');

        // Create admin account
        $table->insert([
            'name' => 'Super Admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => password_hash('admin1234', PASSWORD_BCRYPT),
            'role' => 'admin',
            'status' => 'verifed'
        ]);
        
        $factory = Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {
            $data = [
                'name' => $factory->name(),
                'username' => $factory->userName(),
                'email' => $factory->email(),
                'password' => password_hash('alumni2022', PASSWORD_BCRYPT),
                'role' => 'alumni',
                'status' => (random_int(0, 1) == 1 ? 'verifed' : 'unverifed')
            ];

            $table->insert($data);
        }
    }
}
