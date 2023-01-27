<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JurusanModel;
use App\Models\UsersModel;
use Faker\Factory;

class DashboardController extends BaseController
{
    protected $userModel;
    protected $jurusanModel;

    function __construct()
    {
        $this->userModel = new UsersModel();
        $this->jurusanModel = new JurusanModel();
    }

    public function dashboard()
    {
        $totalAlumni = $this->userModel->select('role', 'alumni')->findAll();
        $totalJurusan = $this->jurusanModel->findAll();

        $this->context['totalAlumni'] = (isset($totalAlumni) ? count($totalAlumni) : 0);
        $this->context['totalJurusan'] = (isset($totalJurusan) ? count($totalJurusan) : 0);

        return $this->render('admin/dashboard');
    }
}
