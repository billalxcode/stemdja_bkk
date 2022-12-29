<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use Config\Services;

class AuthController extends BaseController
{
    protected $userModel;
    protected $session;

    function __construct()
    {
        $this->userModel = new UsersModel();
        $this->session = Services::session();
    }

    public function index()
    {
        return $this->render('auth/login');
    }

    public function verify() {
        helper('form');

        $username = $this->request->getPost('username');
        $passowrd = $this->request->getPost("password");

        $userdata = $this->userModel->where('username', $username)->first();
        if ($userdata) {
            if (password_verify($passowrd, $userdata['password'])) {
                if ($userdata['role'] == 'alumni') {
                    if ($userdata['status'] == 'verifed') {
                        $token = $this->userModel->create_token();
                        $this->userModel->update($userdata['id'], ['remember_token' => $token]);
                        $this->session->set('token', $token);
                        
                        // Send message to view
                        $this->session->setFlashdata('success', 'Anda berhasil login, selamat datang kembali <b>' . $userdata['name'] . '</b>, anda login sebagai ' . $userdata['role']);
                        return redirect()->to('/alumni');
                    } else {
                        $this->session->setFlashdata('error', 'Akun belum diverifikasi, mohon hubungi pihak sekolah.');
                        return redirect()->back()->withInput();
                    }
                } else if ($userdata['role'] == 'admin') {
                    $token = $this->userModel->create_token();
                    $this->userModel->update($userdata['id'], ['remember_token' => $token]);
                    $this->session->set('token', $token);

                    // Send message to view
                    $this->session->setFlashdata('success', 'Anda berhasil login, selamat datang kembali <b>' . $userdata['name'] . '</b>, anda login sebagai admin');
                    return redirect()->to('/admin');
                } else {
                    $this->session->setFlashdata('error', 'Kesalahan pada data, mohon secepatnya verifikasi ke pihak sekolah.');
                    return redirect()->back();
                }    
            } else {
                $this->session->setFlashdata('error', 'Username dan password tidak ditemukan');
                return redirect()->back()->withInput();
            }
        } else {
            $this->session->setFlashdata('error', 'Username dan password tidak ditemukan');
            return redirect()->back()->withInput();
        }
    }

    public function logout() {
        $token = $this->session->get('token');
        $isdeleted = $this->userModel->verify_and_delete($token);
        if ($isdeleted) {
            $this->session->destroy();
            $this->session->setFlashdata('success', 'Anda berhasil logout');
            return redirect()->to('login');
        } else {
            $this->session->setFlashdata('error', 'Maaf sepertinya terjadi kesalahaan pada saat logout');
            return redirect()->to('admin');
        }
    }
}
