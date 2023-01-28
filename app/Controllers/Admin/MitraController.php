<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MitraModel;
use Config\Services;

class MitraController extends BaseController
{
    protected $mitraModel;
    protected $session;

    function __construct()
    {
        $this->mitraModel = new MitraModel();
        $this->session = Services::session();
    }

    public function index()
    {
        return $this->render('admin/mitra/manage');
    }

    public function save() {
        $name = $this->request->getPost("name");
        $address = $this->request->getPost("address");
        $website = $this->request->getPost("site");

        $rules = [
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Data nama wajib diisi'
                ]
                ],
                'address' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Data alamat wajib diisi'
                    ]
                    ]
        ];

        if ($this->validate($rules)) {
            $data = [
                'name' => $name,
                'address' => $address,
                'site' => $website
            ];
    
            $this->mitraModel->save($data);
    
            $this->session->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->back();
        } else {
            $errors = $this->validator->getErrors();
            foreach ($errors as $key => $val) {
                $this->session->setFlashdata('error', $val);
                break;
            }
            return redirect()->back();
        }
    }

    public function delete() {
        $mitra_id = $this->request->getGet('id');

        $mitraData = $this->mitraModel->select('id')->where('id', $mitra_id)->first();
        if ($mitraData) {
            $this->mitraModel->delete($mitraData['id']);

            $this->session->setFlashdata('success', 'Berhasil menghapus data');
        } else {
            $this->session->setFlashdata('error', 'Tidak dapat menghapus data');
        }
        return redirect()->back();
    }
}
