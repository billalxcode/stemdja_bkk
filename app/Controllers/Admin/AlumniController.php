<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AlumniModel;
use App\Models\JurusanModel;
use App\Models\UsersModel;
use CodeIgniter\Database\Exceptions\DatabaseException;
use Config\Services;
use Error;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
        $jurusandata = $this->jurusanModel->select('id,name,short')->findAll();

        $this->context['jurusans'] = $jurusandata;
        // $dataAlumni = $this->alumniModel->getAllData();

        // return $this->response->setJSON(json_encode($dataAlumni));
        return $this->render('admin/alumni/manage');
    }

    public function create() {
        $jurusandata = $this->jurusanModel->select('id,name,short')->findAll();

        $this->context['jurusans'] = $jurusandata;
        return $this->render('admin/alumni/create');
    }

    public function getdata() {
        $dataAlumni = $this->alumniModel->getAllData();

        $data = [
            'status' => true,
            'data' => $dataAlumni,
        ];
        return $this->response->setJSON($data)->setStatusCode(200);
    }

    public function save() {
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
            
            $dataAccount = [
                'email' => $email,
                'name' => $nama_lengkap,
                'username' => $username,
                'password' => password_hash((isset($password) ? $password : 'alumni2022'), PASSWORD_BCRYPT),
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

    public function trash() {
        $data_id  = $this->request->getPost("id");
        
        $deleted = $this->alumniModel->trashData($data_id);
        if ($deleted) {
            $this->session->setFlashdata('success', 'Data berhasil dihapus.');
        } else {
            $this->session->setFlashdata('error', 'Data gagal dihapus');
        }

        return redirect()->back();
    }
    
    public function store() {
        return $this->render("admin/alumni/store");
    }

    public function process_store() {
        helper('random');
        $rules = [
            'files' => [
                'rules' => 'uploaded[files]',
                'errors' => [
                    'uploaded' => 'Maaf file tidak terupload, silahkan ulang lagi'
                ]
            ]
        ];

        if ($this->validate($rules)) {
            $fileformat = $this->request->getPost("fileformat");
            $files = $this->request->getFile("files");
    
            if ($fileformat == "xlsx") {
                $reader =  new Xlsx();
                $spreadsheet = $reader->load($files);
                $data = $spreadsheet->getActiveSheet()->toArray();
                
                list($success, $error) = [0, 0];
                foreach ($data as $key => $val) {
                    if ($key <= 2) {
                        continue;
                    }
                    // if (empty(array_filter($val, function ($a) { return $a !== null;})) == true) {
                    //     $error += 1;
                    // } else {
                    //     $success += 1;
                    // }

                    $val = array_slice($val, 0, 7);
                    list($nama_lengkap, $email, $username, $password, $jenis_kelamin, $kode_jurusan, $tahun_lulus) = $val;
                    try {
                        $jurusan_id = $this->jurusanModel->find_by_code($kode_jurusan);

                        $email = (strtolower($email) == "auto" ? generate_email($nama_lengkap) : $email);
                        $username = (strtolower($username) == "auto" ? generate_username($nama_lengkap) : $username);
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
                            'jenis_kelamin' => ($jenis_kelamin == "L" ? 'male' : 'female'),
                            'tahun_lulus' => $tahun_lulus,
                            'jurusan_id' => ($jurusan_id == false ? '0' : $jurusan_id)
                        ];

                        $this->alumniModel->save($dataAlumni);
                        $success += 1;
                    } catch (DatabaseException $e) {
                        $error += 1;
                    }
                    // try {
                    //     list($nama_lengkap, $email, $username, $password, $jurusan_id, $tahun_lulus, $status, $tempat_kerja, $jenis_kelamin, $alamat) = $val;
    
                    //     $dataAccount = [
                    //         'email' => $email,
                    //         'name' => $nama_lengkap,
                    //         'username' => $username,
                    //         'password' => password_hash($password, PASSWORD_BCRYPT),
                    //         'role' => 'alumni'
                    //     ];
                    //     $this->userModel->save($dataAccount);
    
                    //     $getDataAccount = $this->userModel->select('id')->where('email', $email)->first();
                        
                    //     $dataAlumni = [
                    //         'user_id' => $getDataAccount['id'],
                    //         'jenis_kelamin' => $jenis_kelamin,
                    //         'jurusan_id' => $jurusan_id,
                    //         'tahun_lulus' => $tahun_lulus,
                    //         'alamat' => $alamat,
                    //         'status' => $status,
                    //         'kontak' => '',
                    //         'tempat_kerja' => $tempat_kerja
                    //     ];
    
                    //     $this->alumniModel->save($dataAlumni);
                    //     $success += 1;
                    // } catch (Exception $e) {
                    //     $error += 1;
                    // }
                }
                $this->session->setFlashdata('success', 'Data berhasil di import, sukses ' . $success . ', error ' . $error);
                return redirect()->back();
            } else {
                $this->session->setFlashdata('error', 'Maaf file tidak mendukung, coba file yang lain nya.');
                return redirect()->back()->withInput();
            }
        } else {
            $this->session->setFlashdata('error', 'Maaf file tidak terupload, silahkan ulang lagi');
            return redirect()->back();
        }
    }

    public function download() {
        $fileformat = $this->request->getPost('fileformat');
        
        // Initialize spreadsheet
        $alphabets = [
            'A' => 'Nama Lengkap',
            'B' => 'Email',
            'C' => "Username",
            'D' => 'Jurusan',
            'E' => "Tahun Lulus",
            'F' => 'Status',
            'G' => 'Tempat Kerja',
            'H' => 'Jenis Kelamin',
            'I' => 'Alamat'
        ];
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->setActiveSheetIndex(0);
        foreach ($alphabets as $alpha => $val) {
            $sheet->getColumnDimension($alpha)->setAutoSize(true);
            $sheet->setCellValue($alpha . '1', $val);
        }
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        
        $properties = $spreadsheet->getProperties();
        $properties->setCreator('Billal Fauzan');
        $properties->setLastModifiedBy('Billal Fauzan');
        $properties->setTitle('Official exported data alumni');
        $properties->setSubject('Official exported data alumni');
    
        // Get all data from database and write to sheet
        $row = 1;
        $alumniData = $this->alumniModel->findAll();
        foreach ($alumniData as $alumni) {
            $row++;
            $userData = $this->userModel->select('name,username,email')->where('id', $alumni['user_id'])->first();
            $jurusanData = $this->jurusanModel->select('short')->where('id', $alumni['jurusan_id'])->first();
            if ($jurusanData) {
                $jurusanName = $jurusanData['short'];
            } else {
                $jurusanName = '';
            }

            $sheet->setCellValue('A' . $row, $userData['name']);
            $sheet->setCellValue('B' . $row, $userData['email']);
            $sheet->setCellValue('C' . $row, $userData['username']);
            $sheet->setCellValue('D' . $row, $jurusanName);
            $sheet->setCellValue('E' . $row, $alumni['tahun_lulus']);
            $sheet->setCellValue('F' . $row, $alumni['status']);
            $sheet->setCellValue('G' . $row, $alumni['tempat_kerja']);
            $sheet->setCellValue('H' . $row, $alumni['jenis_kelamin']);
            $sheet->setCellValue('I' . $row, $alumni['alamat']);
        }
        ob_end_clean();
        if ($fileformat == "csv") {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename=Data Alumni.csv');
            header('Cache-Control: max-age=0');
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
            $writer->save('php://output');
            exit();
        } else if ($fileformat == "xlsx") {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Cache-Control: max-age=0');
            header('Content-Disposition: attachment;filename=Data Alumni.xlsx');
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
            exit();
        } else if ($fileformat == "ods") {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Cache-Control: max-age=0');
            header('Content-Disposition: attachment;filename=Data Alumni.ods');
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Ods($spreadsheet);
            $writer->save('php://output');
            exit();
        } else {
            $this->session->setFlashdata('error', 'Maaf format data tidak didukung');
            return redirect()->back();
        }
    }

    public function print() {
        $data = $this->alumniModel->findAll();

        return $this->render('admin/alumni/print', $data);
    }

    public function rekap() {
        $rekapDataTahunLulus = $this->alumniModel->get_rekapDataTahunLulus();
        $rekapDataStatus = $this->alumniModel->get_rekapStatus();
        $rekapDataJurusan = $this->alumniModel->get_rekapJurusan();

        $this->context['rekapData_status'] = $rekapDataStatus;
        $this->context['rekapData_tahunlulus'] = $rekapDataTahunLulus;
        $this->context['rekapData_jurusan'] = $rekapDataJurusan;
        return $this->render("admin/alumni/rekap");
    }

    public function update() {
        $user_id = $this->request->getPost('user_id');
        $status = $this->request->getPost('status');
        $jurusan = $this->request->getPost("jurusan");

        if (isset($user_id)) {
            $alumnidata = $this->alumniModel->find($user_id);

            if ($alumnidata) {
                $this->alumniModel->update($user_id, [
                    'status' => $status,
                    'jurusan_id' => $jurusan
                ]);

                $this->session->setFlashdata('success', 'Data berhasil disimpan');
                return redirect()->back();
            } else {
                $this->session->setFlashdata('error', 'Maaf data tidak ditemukan');
                return redirect()->back();
            }
        }
    }

    public function reset() {
        $dataUsers = $this->userModel->select('id')->where('role', 'alumni')->findAll();
        foreach ($dataUsers as $data) {
            $dataAlumni = $this->alumniModel->select('id')->where('user_id', $data['id'])->first();
            $this->alumniModel->delete($dataAlumni['id']);
            $this->userModel->delete($data['id']);
        }

        $this->session->setFlashdata('success', 'Data berhasil di reset!');
        return redirect()->back();
    }
}
