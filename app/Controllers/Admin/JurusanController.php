<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JurusanModel;
use Config\Services;

class JurusanController extends BaseController
{
    protected $session;
    protected $jurusanModel;

    function __construct()
    {
        $this->session = Services::session();
        $this->jurusanModel = new JurusanModel();
    }

    public function manage()
    {
        return $this->render('admin/jurusan/manage');
    }

    public function save() {
        $name = $this->request->getPost("name");
        $short = $this->request->getPost("short");

        $this->jurusanModel->save([
            'name' => $name,
            'short' => $short
        ]);

        $this->session->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->back();
    }

    public function getAll() {
        // Temporary API
        $jurusan_data = $this->jurusanModel->select('id,name,short')->findAll();

        $this->context['data'] = $jurusan_data;

        return $this->renderContext();
    }
}
