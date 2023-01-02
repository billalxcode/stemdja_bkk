<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CitiesModel;
use App\Models\ProvinceModel;

class WilayahController extends BaseController
{
    protected $provinceModel;
    protected $citiesModel;

    function __construct()
    {
        $this->provinceModel = new ProvinceModel();
        $this->citiesModel = new CitiesModel();
    }

    public function get_provinsi() {
        $search = $this->request->getPost('query');
        if ($search) {
            $data = $this->provinceModel->select('code,name')->like('name', $search)->findAll();
        } else {
            $data = $this->provinceModel->select('code,name')->findAll();
        }

        $this->context['status'] = true;
        $this->context['data'] = $data;
        return $this->renderContext();
    }

    public function get_kota() {
        $provinsi = $this->request->getGet('code');
        $search = $this->request->getPost("query");

        $selector = $this->citiesModel->select('code,name')->where('province_code', $provinsi);
        if ($search) {
            $data = $selector->like('name', $search)->findAll();
        } else {
            $data = $selector->findAll();
        }

        $this->context['status'] = true;
        $this->context['data'] = $data;

        return $this->renderContext();
    }
}
