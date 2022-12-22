<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AlumniModel;
use App\Models\JurusanModel;
use Config\Services;

class AlumniController extends BaseController
{
    protected $session;
    protected $alumniModel;
    protected $jurusanModel;
    
    function __construct()
    {
        $this->alumniModel = new AlumniModel();
        $this->jurusanModel = new JurusanModel();
        $this->session = Services::session();
    }

    public function manage()
    {
        return $this->render('admin/alumni/manage');
    }

    public function create() {
        $jurusandata = $this->jurusanModel->select('id,name,short')->findAll();

        $this->context['jurusans'] = $jurusandata;
        return $this->render('admin/alumni/create');
    }
}
