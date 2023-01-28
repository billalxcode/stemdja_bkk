<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\MitraModel;

class Mitra extends BaseController
{
    protected $mitraModel;

    function __construct()
    {
        $this->mitraModel = new MitraModel();
    }

    public function getall()
    {
        $dataMitra = $this->mitraModel->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $dataMitra
        ])->setStatusCode(200);
    }
}
