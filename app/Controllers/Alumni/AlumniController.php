<?php

namespace App\Controllers\Alumni;

use App\Controllers\BaseController;
use Config\Services;

class AlumniController extends BaseController
{
    protected $session;
    protected $userModel;
    protected $lokerModel;
    protected $alumniModel;
    protected $jurusanModel;

    function __construct()
    {
        $this->session = Services::session();
        $this->userModel = new \App\Models\UsersModel();
        $this->lokerModel = new \App\Models\LowonganModel();
        $this->alumniModel = new \App\Models\AlumniModel();
        $this->jurusanModel = new \App\Models\JurusanModel();
    }

    public function dashboard()
    {
        $this->getUserData();
        $userDetails = $this->context['userdata']['details'];
        if (!isset($userDetails)) {
            $this->session->setFlashdata('warning', "Data profil anda belum diisi, mohon segera isi data profil.");
        } else {
            if (isset($userDetails['jurusan_id'])) {
                $existJurusan = $this->jurusanModel->where('id', $userDetails['jurusan_id'])->first();
                if (!$existJurusan) {
                    $this->session->setFlashdata('warning', 'Data jurusan anda belum diperbaharui, segera perbaharui data jurusan anda.');
                }
            }

            if (!isset($userDetails['status'])) {
                $this->session->setFlashdata('warning', 'Data status kamu belum diperbaharui, segera perbaharui data status kamu.');
            }

            if (!isset($userDetails['alamat'])) {
                $this->session->setFlashdata('warning', 'Data alamat kamu belum diisi, mohon segera isi alamat kamu.');
            }
        }
        $lokerdata = $this->lokerModel->findAll();
        $this->context['lokerdata'] = $lokerdata;
        return $this->render('alumni/dashboard');
    }

    public function profilePage() {
        $token = $this->session->get('token');
        $userdata = $this->userModel->select('id,name,username,email')->where('remember_token', $token)->first();
        $alumnidata = $this->alumniModel->where('user_id', $userdata['id'])->first();
        $jurusanData = $this->jurusanModel->select('id,name,short')->findAll();
        $userdata['details'] = $alumnidata;
        
        $this->context['jurusans'] = $jurusanData;
        $this->context['data'] = $userdata;
        
        return $this->render('alumni/profile/page');
    }

    public function profileSave() {
        $token = $this->session->get('token');
        
        $userid         = $this->request->getPost('id');
        $nama_lengkap   = $this->request->getPost("nama_lengkap");
        $email          = $this->request->getPost("email");
        $username       = $this->request->getPost("username");
        $jurusan        = $this->request->getPost("jurusan");
        $tahun_lulus    = $this->request->getPost("tahun_lulus");
        $status         = $this->request->getPost("status");
        $tempat_kerja   = $this->request->getPost("tempat_kerja");
        $jenis_kelamin  = $this->request->getPost("jenis_kelamin");
        $alamat         = $this->request->getPost("alamat");
        
        $userdata = $this->userModel->find($userid);
        // $userdata = $this->userModel->select('id')->where('remember_token', $token)->first();

        $dataAccount = [
            'email' => $email,
            'name' => $nama_lengkap,
            'username' => $username
        ];

        $this->userModel->update($userdata['id'], $dataAccount);

        // $getDataAlumni = $this->alumniModel->where('user_id', $userdata['id'])->countAllResults();
        $getDataAlumni = $this->alumniModel->where('user_id', $userdata['id'])->first();
        $dataAlumni = [
            'user_id' => $userdata['id'],
            'jenis_kelamin' => $jenis_kelamin,
            'jurusan_id' => $jurusan,
            'tahun_lulus' => $tahun_lulus,
            'alamat' => $alamat,
            'status' => $status,
            'kontak' => '',
            'tempat_kerja' => $tempat_kerja
        ];

        if ($getDataAlumni == null) {
            $this->alumniModel->save($dataAlumni);
            $this->session->setFlashdata('success', 'Data berhasil disimpan');
        } else {
            $this->alumniModel->update($getDataAlumni['id'], $dataAlumni);
            $this->session->setFlashdata('success', 'Data berhasil diperbaharui');
        }

        return redirect()->back();
    }

    public function lokerPage() {
        $search  = $this->request->getGet('s');
        $data = $this->lokerModel->find_loker($search);

        $this->context['lokerData'] = $data;
        $this->context['search'] = $search;
        return $this->render('alumni/loker/page');
    }
}
