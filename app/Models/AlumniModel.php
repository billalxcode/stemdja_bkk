<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumniModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'alumni';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'jenis_kelamin', 'jurusan_id', 'tahun_lulus', 
        'alamat', 'status', 'kontak', 'tempat_kerja'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllData(string $type = "private") {
        $token = session()->get('token');

        $userModel = new \App\Models\UsersModel();
        $jurusanModel = new \App\Models\JurusanModel();

        $alumnidata = $this->findAll();
        $alumnidata_rev = [];
        foreach ($alumnidata as $data) {
            $id = $data['id'];
            $userdata = $userModel->select('name,username,email,remember_token')->where('id', $id)->first();
            if ($userdata) {
                if ($type == "private" && isset($userdata) && $userdata['remember_token'] == $token) {
                    continue;
                }
                $jurusandata = $jurusanModel->select('name')->where('id', $data['jurusan_id'])->first();
                $data['jurusan'] = $jurusandata;
                foreach ($userdata as $key => $val) {
                    $data[$key] = $val;
                }
                array_push($alumnidata_rev, $data);
            }
        }

        return $alumnidata_rev;
    }

    public function trashData($data_id) {
        $userModel = new \App\Models\UsersModel();

        $data = $this->select('id,user_id')->where('id', $data_id)->first();
        if ($data) {
            $userData = $userModel->select('id')->where('id', $data['user_id'])->first();
            if ($userData) {
                $userModel->delete($userData['id']);
                $this->delete($data['id']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_rekapDataTahunLulus() {
        $rekapData_real = [];
        $statuses = ['belum_bekerja', 'bekerja', 'kuliah', 'berwirausaha'];
        for ($i = 2000; $i < date('Y'); $i++) {
            $rekapData_col = [];
            $rekapData_col['tahun_lulus'] = $i;
            foreach ($statuses as $status) {
                $alumniData = $this->select('*')->where(['tahun_lulus' => $i, 'status' => $status])->findAll();
                $rekapData_col[$status] = count($alumniData);
            }
            array_push($rekapData_real, $rekapData_col);
        }

        return $rekapData_real;
    }

    public function get_rekapStatus() {
        $rekapData_real = [];
        $statuses = ['belum_bekerja', 'bekerja', 'kuliah', 'berwirausaha'];
        foreach ($statuses as $status) {
            $alumniData = $this->select('*')->where('status', $status)->findAll();
            $rekapData_real[$status] = count($alumniData);
        }
        
        return $rekapData_real;
    }

    public function get_rekapJurusan() {
        $jurusanModel = new \App\Models\JurusanModel();
        $jurusanData = $jurusanModel->select('id,name')->findAll();
        $statuses = ['belum_bekerja', 'bekerja', 'kuliah', 'berwirausaha'];
        $rekapData_real = [];
        
        foreach ($jurusanData as $jurusan) {
            $rekapData_col = [];
            $rekapData_col['jurusan'] = $jurusan['name'];
            foreach ($statuses as $status) {
                $alumniData = $this->select('*')->where(['status' => $status, 'jurusan_id' => $jurusan['id']])->findAll();
                $rekapData_col[$status] = count($alumniData);
            }
            array_push($rekapData_real, $rekapData_col);
        }

        return $rekapData_real;
    }
}
