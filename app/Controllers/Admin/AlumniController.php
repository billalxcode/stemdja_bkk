<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AlumniModel;
use App\Models\JurusanModel;
use App\Models\UsersModel;
use Config\Services;

class AlumniController extends BaseController
{
    protected $session;
    protected $alumniModel;
    protected $jurusanModel;
    protected $userModel;

    function __construct()
    {
        $this->alumniModel = new AlumniModel();
        $this->jurusanModel = new JurusanModel();
        $this->userModel = new UsersModel();
        $this->session = Services::session();
    }

    public function manage()
    {
        $dataAlumni = $this->alumniModel->getAllData();

        // return $this->response->setJSON(json_encode($dataAlumni));
        return $this->render('admin/alumni/manage');
    }

    public function create() {
        $jurusandata = $this->jurusanModel->select('id,name,short')->findAll();

        $this->context['jurusans'] = $jurusandata;
        return $this->render('admin/alumni/create');
    }

    public function getAll() {
        $dataAlumni = $this->alumniModel->getAllData();

        $data = [
            'status' => true,
            'data' => $dataAlumni,
        ];
        return $this->response->setJSON($data)->setStatusCode(200);
    }

    public function save() {
        $nama_lengkap   = $this->request->getPost("nama_lengkap");
        $email          = $this->request->getPost("email");
        $username       = $this->request->getPost("username");
        $password       = $this->request->getPost("password");
        $jurusan        = $this->request->getPost("jurusan");
        $tahun_lulus    = $this->request->getPost("tahun_lulus");
        $status         = $this->request->getPost("status");
        $tempat_kerja   = $this->request->getPost("tempat_kerja");
        $jenis_kelamin  = $this->request->getPost("jenis_kelamin");
        $alamat         = $this->request->getPost("alamat");

        $rules = [
            'email' => [
                'rules' => 'valid_email|is_unique[users.email]',
                'errors' => [
                    'valid_email' => 'Maaf email yang anda masukan tidak valid',
                    'is_unique' => 'Maaf email sudah ada, Mohon gunakan email yang lain.'
                ]
            ],
            'username' => [
                'rules' => 'is_unique[users.username]',
                'errors' => [
                    'is_uniques' => 'Maaf username sudah digunakan, mohon gunakan username yang lain.'
                ]
            ]
        ];

        if ($this->validate($rules)) {
            $dataAccount = [
                'email' => $email,
                'name' => $nama_lengkap,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'role' => 'alumni'
            ];

            $this->userModel->save($dataAccount);

            $getDataAccount = $this->userModel->select('id')->where('email', $email)->first();
            
            $dataAlumni = [
                'user_id' => $getDataAccount['id'],
                'jenis_kelamin' => $jenis_kelamin,
                'jurusan_id' => $jurusan,
                'tahun_lulus' => $tahun_lulus,
                'alamat' => $alamat,
                'status' => $status,
                'kontak' => '',
                'tempat_kerja' => $tempat_kerja
            ];

            $this->alumniModel->save($dataAlumni);

            $this->session->setFlashdata('success', 'Data berhasil disimpan.');
            return redirect()->back();
        } else {
            $error = $this->validator->getErrors();
            foreach ($error as $key => $val) {
                $this->session->setFlashdata('error', $val);
                break;
            }
            return redirect()->back()->withInput();
        }
    }
}
