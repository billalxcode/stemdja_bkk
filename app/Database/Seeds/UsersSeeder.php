<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $userModel = new \App\Models\UsersModel();
        $alumniModel = new \App\Models\AlumniModel();

        // Create admin account
        $userModel->save([
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

            $userModel->save($data);
            $userdata = $userModel->select('id')->where('email', $data['email'])->first();
            $dataAlumni = [
                'user_id' => $userdata['id'],
                'jenis_kelamin' => (random_int(0, 1) == 1 ? 'male' : 'female'),
                'jurusan_id' => 0,
                'tahun_lulus' => random_int(1999, 2021),
                'alamat' => $factory->address(),
                'status' => 'kuliah',
                'tempat_kerja' => $factory->address()
            ];
            $alumniModel->save($dataAlumni);
        }
    }
}
