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

    public function getAllData() {
        $userModel = new \App\Models\UsersModel();
        $jurusanModel = new \App\Models\JurusanModel();

        $alumnidata = $this->findAll();
        $alumnidata_rev = [];
        foreach ($alumnidata as $data) {
            $id = $data['id'];
            $userdata = $userModel->select('name,username,email')->where('id', $id)->first();
            $jurusandata = $jurusanModel->select('name')->where('id', $data['jurusan_id'])->first();
            $data['jurusan'] = $jurusandata;
            foreach ($userdata as $key => $val) {
                $data[$key] = $val;
            }
            array_push($alumnidata_rev, $data);
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
}
