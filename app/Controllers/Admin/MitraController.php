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
                    ],
                    'site' => [
                        'rules' => 'required',
                        'errors' => [
                            'required' => 'Data website wajib diisi'
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
}
