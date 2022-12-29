<?php

namespace App\Controllers\Alumni;

use App\Controllers\BaseController;
use Config\Services;

class AlumniController extends BaseController
{
    protected $session;
    protected $userModel;
    protected $lokerModel;

    function __construct()
    {
        $this->session = Services::session();
        $this->userModel = new \App\Models\UsersModel();
        $this->lokerModel = new \App\Models\LowonganModel();
    }

    public function dashboard()
    {
        $this->getUserData();
        
        $lokerdata = $this->lokerModel->findAll();
        $this->context['lokerdata'] = $lokerdata;
        return $this->render('alumni/dashboard');
    }

    public function profilePage() {
        $token = $this->session->get('token');
        $userdata = $this->userModel->select('name,username,email')->where('remember_token', $token)->first();

        $this->context['data'] = $userdata;

        return $this->render('alumni/profile/page');
    }

    public function profileSave() {
        $token = $this->session->get('token');
        $userdata = $this->userModel->select('id')->where('remember_token', $token)->first();

        
    }
}
