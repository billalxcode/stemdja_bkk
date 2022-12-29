<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;

class SchoolController extends BaseController
{
    protected $session;
    protected $schoolModel;
    
    function __construct()
    {
        $this->session = Services::session();
        $this->schoolModel = new \App\models\SchoolModel();
    }

    public function index()
    {
        $data = $this->schoolModel->first();
        
        $this->context['data'] = $data;

        return $this->render('admin/school/page');
    }

    public function save() {
        $nama_sekolah = $this->request->getPost("nama_sekolah");
        $alamat = $this->request->getPost("alamat");
        $skoperasional = $this->request->getPost("skoperasional");
        $tgl_skoperasional = $this->request->getPost("tgl_skoperasional");
        $nama_kepsek = $this->request->getPost("nama_kepsek");
        $nama_operator = $this->request->getPost("nama_operator");

        $data = [
            'nama_sekolah' => $nama_sekolah,
            'alamat' => $alamat,
            'skoperasional' => $skoperasional,
            'tgl_skoperasional' => $tgl_skoperasional,
            'nama_kepsek' => $nama_kepsek,
            'operator' => $nama_operator
        ];
        $first = $this->schoolModel->first();
        if (!$first) {
            $this->session->setFlashdata('success', 'Data berhasil disimpan');
            $this->schoolModel->save($data);
        } else {
            $this->session->setFlashdata('success', 'Data berhasil diperbaharui');
            $this->schoolModel->update($first['id'], $data);
        }

        return redirect()->to('admin/school');
    }
}
