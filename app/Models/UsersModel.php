<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'name', 'username', 'email', 'password', 'status', 'role', 'remember_token'
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

    public function create_token() {
        $alpha = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $randombyte = random_bytes(rand(1024, 1024*3));
        $hashes = hash('sha256', $randombyte);
        $base64 = base64_encode($hashes);
        $hashes2 = hash('md5', $base64);
        return 'TOKEN:' . $hashes2;
    }

    public function verify_and_delete($token) {
        $userdata = $this->select('id')->where('remember_token', $token)->first();
        if (!$userdata) {
            return false;
        }
        $this->update($userdata['id'], [
            'remember_token' => null
        ]);
        return true;
    }
}
