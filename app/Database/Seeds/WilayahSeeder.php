<?php

namespace App\Database\Seeds;

use App\Models\CitiesModel;
use App\Models\ProvinceModel;
use CodeIgniter\Database\Seeder;

class WilayahSeeder extends Seeder
{
    public function run()
    {
        // Provinces Seeder
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        $spreadsheet = $reader->load(WRITEPATH . '/resource/wilayah/provinces.csv');
        $data = $spreadsheet->getActiveSheet()->toArray();
        
        $provinceModel = new ProvinceModel();
        foreach ($data as $provinsi) {
            list($code,$name) = $provinsi;

            if (!$provinceModel->where('code', $code)->first()) {
                $provinceModel->save([
                    'code' => $code,
                    'name' => $name
                ]);
            }
        }

        $spreadsheet = $reader->load(WRITEPATH . '/resource/wilayah/cities.csv');
        $data = $spreadsheet->getActiveSheet()->toArray();
        $citiesModel = new CitiesModel();
        foreach ($data as $kota) {
            list($code, $provinsi_kode, $name) = $kota;

            if (!$citiesModel->where('code', $code)->first()) {
                $citiesModel->save([
                    'code' => $code,
                    'province_code' => $provinsi_kode,
                    'name' => $name
                ]);
            }
        }
    }
}
