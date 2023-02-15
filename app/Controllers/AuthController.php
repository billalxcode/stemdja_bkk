<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlumniModel;
use App\Models\JurusanModel;
use App\Models\UsersModel;
use Config\Services;

class AuthController extends BaseController
{
    protected $userModel;
    protected $jurusanModel;
    protected $alumniModel;
    protected $session;

    function __construct()
    {
        $this->userModel = new UsersModel();
        $this->jurusanModel = new JurusanModel();
        $this->alumniModel = new AlumniModel();
        $this->session = Services::session();
    }

    public function index()
    {
        return $this->render('auth/login');
    }

    public function register() {
        $jurusandata = $this->jurusanModel->select('id,name,short')->findAll();

        $this->context['jurusans'] = $jurusandata;
        return $this->render('auth/register');
    }

    public function save() {
        $rules = [
            'email' => [
                'rules' => 'valid_email|is_unique[users.email]',
                'errors' => [
                    'valid_email' => 'Maaf email yang anda masukan tidak valid',
                    'is_unique' => 'Maaf email sudah ada, Mohon gunakan email yang lain'
                ]
            ],
            'username' => [
                'rules' => 'is_unique[users.username]',
                'errors' => [
                    'is_unique' => 'Maaf username sudah digunakan. Mohon gunakan username yang lain.'
                ]
            ]
        ];

        if ($this->validate($rules)) {
            $nama_lengkap = $this->request->getPost('nama_lengkap');
            $username = $this->request->getPost('username');
            $email = $this->request->getPost("email");
            $jurusan = $this->request->getPost("jurusan");
            $jenis_kelamin = $this->request->getPost("jenis_kelamin");
            $tahun_lulus = $this->request->getPost('tahun_lulus');
            $password = $this->request->getPost("password");
            $status = $this->request->getPost('status');
            $tempat_kerja = $this->request->getPost('tempat_kerja');

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
                'tahun_lulus' => $tahun_lulus,
                'jurusan_id' => $jurusan,
                'status'    => $status,
                'tempat_kerja'  => $tempat_kerja
            ];

            $this->alumniModel->save($dataAlumni);

            $this->session->setFlashdata('success', 'Daftar telah berhasil, silahkan login');
            return redirect()->to('login');
        } else {
            $error = $this->validator->getErrors();
            foreach ($error as $key => $val) {
                $this->session->setFlashdata('error', $val);
                break;
            }
            return redirect()->back()->withInput();
        }
        
    }

    public function verify() {
        helper('form');

        $username = $this->request->getPost('username');
        $password = $this->request->getPost("password");

        $userdata = $this->userModel->where('username', $username)->first();
        if ($userdata) {
            if (password_verify($password, $userdata['password'])) {
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
