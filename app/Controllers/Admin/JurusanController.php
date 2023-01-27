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
        $kode = $this->request->getPost("kode");
        $name = $this->request->getPost("name");
        $short = $this->request->getPost("short");

        $this->jurusanModel->save([
            'kode' => $kode,
            'name' => $name,
            'short' => $short
        ]);

        $this->session->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->back();
    }

    public function getAll() {
        // Temporary API
        $jurusan_data = $this->jurusanModel->select('id,kode,name,short')->findAll();

        $this->context['data'] = $jurusan_data;

        return $this->renderContext();
    }

    public function delete() {
        $jurusan_id = $this->request->getGet('id');
        if (isset($jurusan_id)) {
            $exists = $this->jurusanModel->select('id')->where('id', $jurusan_id)->first();
            if ($exists) {
                $this->jurusanModel->delete($exists['id']);
                $this->session->setFlashdata('success', 'Data berhasil dihapus');
            } else {
                $this->session->setFlashdata('error', 'Maaf data gagal dihapus');
            }

            return redirect()->back();
        } else {

        }
    }
}
