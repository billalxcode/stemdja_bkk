<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

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

        // Create siswa account
        $table->insert([
            'name' => 'Agis nur anjani',
            'username' => 'siswa1',
            'email' => 'siswa@admin.com',
            'password' => password_hash('siswa1234', PASSWORD_BCRYPT),
            'role' => 'siswa',
            'status' => 'verifed'
        ]);

        // Create alumni account - Coming soon
    }
}
