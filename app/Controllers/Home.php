<?php

namespace App\Controllers;

use App\Models\JurusanModel;
use App\Models\LowonganModel;
use App\Models\UsersModel;

class Home extends BaseController
{
    protected $userModel;
    protected $lokerModel;
    protected $jurusanModel;

    function __construct()
    {
        $this->userModel = new UsersModel();
        $this->lokerModel = new LowonganModel();
        $this->jurusanModel = new JurusanModel();
    }
    
    public function index()
    {
        $totalJurusan = $this->jurusanModel->findAll();
        $totalAlumni = $this->userModel->where('role', 'alumni')->findAll();
        $totalLoker = $this->lokerModel->findAll();
        $this->context['transparent'] = true;
        $this->context['totalAlumni'] = (isset($totalAlumni) ? count($totalAlumni) : 0);
        $this->context['totalLoker'] = (isset($totalLoker) ? count($totalLoker) : 0);
        $this->context['totalJurusan'] = (isset($totalJurusan) ? count($totalJurusan) : 0);
        return $this->render("home");
    }

    public function alumniIndex() {
        return $this->render("alumniIndex");
    }
}
