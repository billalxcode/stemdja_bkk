<?php

namespace App\Models;

use CodeIgniter\Model;

class LowonganModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'info_lowongans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title', 'corporate_name', 'corporate_contact', 'expired_date', 'kualifikasi'
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

    public function create_data($title, $corporate_name, $corporate_contact, $expired_date, $kualifikasi) {
        return [
            'title' => $title,
            'corporate_name' => $corporate_name,
            'corporate_contact' => $corporate_contact,
            'expired_date' => $expired_date,
            'kualifikasi' => $kualifikasi
        ];
    }

    public function get_all_data() {
        $data = $this->select('id,title,corporate_name,corporate_contact,expired_date,kualifikasi,created_at')->findAll();

        return $data;
    }
}
