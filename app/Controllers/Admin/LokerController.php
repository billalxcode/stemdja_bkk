<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;
use Exception;

class LokerController extends BaseController
{
    protected $lokerModel;
    protected $session;

    function __construct()
    {
        $this->session = Services::session();
        $this->lokerModel = new \App\Models\LowonganModel();
    }

    public function manage()
    {
        return $this->render('admin/loker/manage');
    }

    public function create() {
        return $this->render('admin/loker/create');
    }

    public function save() {
        $title              = $this->request->getPost("title");
        $corporate_name     = $this->request->getPost("corporate_name");
        $corporate_contact  = $this->request->getPost("corporate_contact");
        $expired_date       = $this->request->getPost("expired_date");
        $kualifikasi        = $this->request->getPost("kualifikasi");

        $data = $this->lokerModel->create_data($title, $corporate_name, $corporate_contact, $expired_date, $kualifikasi);
        $this->lokerModel->save($data);

        $this->session->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->back();
    }

    public function getAll() {
        $data = $this->lokerModel->get_all_data();

        return $this->response->setJSON([
            'status' => true,
            'data' => $data
        ])->setStatusCode(200);
    }

    public function store() {
        return $this->render('admin/loker/store');
    }
    
    public function process_store() {
        $rules = [
            'files' => [
                'rules' => 'uploaded[files]',
                'errors' => [
                    'uploaded' => 'Maaf file tidak dapat diupload'
                ]
            ]
        ];

        if ($this->validate($rules)) {
            $fileformat = $this->request->getPost("fileformat");
            $files = $this->request->getFile('files');

            if ($fileformat == "xlsx") {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($files);

                $data = $spreadsheet->getActiveSheet()->toArray();

                list($success, $error) = [0, 0];
                foreach ($data as $key => $val) {
                    if ($key == 0) {
                        continue;
                    }

                    try {
                        list($title, $kualifikasi, $corporate_name, $corporate_contact, $expired_date) = $val; 
                        $lokers = $this->lokerModel->create_data($title, $corporate_name, $corporate_contact, $expired_date, $kualifikasi);
                        
                        $this->lokerModel->save($lokers);
                        $success++;
                    } catch (Exception $e) {
                        $error++;
                    }
                }

                $this->session->setFlashdata('success', 'Data berhasil di import, sukses ' . $success . ', error ' . $error);
                return redirect()->back();
            }
        }
    }
}
