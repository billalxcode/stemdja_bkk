<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LowonganModel;

class LokerController extends BaseController
{
    protected $lokerModel;

    function __construct()
    {
        $this->lokerModel = new LowonganModel();
    }
    public function index()
    {
        $search  = $this->request->getGet('s');
        $data = $this->lokerModel->find_loker($search, true);

        $this->context['lokerData'] = $data;
        $this->context['search'] = $search;
        return $this->render('loker/page');
    }
}
