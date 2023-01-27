<?php

namespace App\Database\Seeds;

use App\Models\JurusanModel;
use CodeIgniter\Database\Seeder;

class JurusanSeeder extends Seeder
{
    protected $jurusanModel;

    function __construct()
    {
        $this->jurusanModel = new JurusanModel();
    }

    public function run()
    {
        $jurusanData = [
            [
                'kode' => 'RPL01',
                'name' => "Rekayasa Perangkat Lunak",
                'short' => "RPL"
            ],
            [
                'kode' => 'TKJ01',
                'name' => "Teknik Komputer dan Jaringan",
                'short' => 'TKJ'
            ]
            ];
        $this->jurusanModel->insertBatch($jurusanData);
    }
}
