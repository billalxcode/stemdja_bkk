<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;

class ProfileController extends BaseController
{
    protected $session;
    protected $userModel;

    function __construct()
    {
        $this->session = Services::session();
        $this->userModel = new \App\models\UsersModel();
    }

    public function index()
    {
        $token = $this->session->get('token');
        $userdata = $this->userModel->select('name,username,email')->where('remember_token', $token)->first();
        
        $this->context['data'] = $userdata;

        return $this->render('admin/profile/page');
    }

    public function save() {
        $token = $this->session->get('token');
        $userdata = $this->userModel->select('id')->where('remember_token', $token)->first();

        $nama_lengkap = $this->request->getPost("nama_lengkap");
        $username = $this->request->getPost("username");
        $email = $this->request->getPost("email");

        $data = [
            'name' => $nama_lengkap,
            'username' => $username,
            'email' => $email
        ];

        $this->userModel->update($userdata['id'], $data);

        $this->session->setFlashdata('success', 'Data berhasil diperbaharui');
        return redirect()->back();
    }
}
