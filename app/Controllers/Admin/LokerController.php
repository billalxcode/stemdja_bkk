<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

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
        $title              = $this->request->getPost('title');
        $corporate_name     = $this->request->getPost('corporate_name');
        $corporate_contact  = $this->request->getPost("corporate_contact");
        $pendidikan         = $this->request->getPost("pendidikan");
        $tipe_pekerjaan     = $this->request->getPost("tipe_pekerjaan");
        $provinsi           = $this->request->getPost("provinsi");
        $kota               = $this->request->getPost("kota");
        $expired_date       = $this->request->getPost("expired_date");
        $deskripsi          = $this->request->getPost('deskripsi');

        $data = $this->lokerModel->create_data($title, $corporate_name, $corporate_contact, $expired_date, $pendidikan, $tipe_pekerjaan, $provinsi, $kota, $deskripsi);

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
                        // $lokers = $this->lokerModel->create_data($title, $corporate_name, $corporate_contact, $expired_date, $pendidikan, $tipe_pekerjaan, $provinsi, $kota, $deskripsi);
                        
                        // $this->lokerModel->save($lokers);
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

    public function download() {
        $fileformat = $this->request->getPost('fileformat');

        $alphabets = [
            'A' => 'Judul',
            'B' => 'Kualifikasi',
            'C' => 'Nama Perusahaan',
            'D' => 'Kontak Perusahaan',
            'E' => 'Tanggal Akhir'
        ];

        // Initialize spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->setActiveSheetIndex(0);
        foreach ($alphabets as $alpha => $val) {
            $sheet->getColumnDimension($alpha)->setAutoSize(true);
            $sheet->setCellValue($alpha . '1', $val);
        }

        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        $properties = $spreadsheet->getProperties();
        $properties->setCreator('Billal Fauzan');
        $properties->setLastModifiedBy('Billal Fauzan');
        $properties->setTitle('Official exported lowongan pekerjaan');
        
        $row = 1;
        $lokerData = $this->lokerModel->select('title,kualifikasi,corporate_name,corporate_contact,expired_date')->findAll();
        foreach ($lokerData as $loker) {
            $row++;
            $sheet->setCellValue('A' . $row, $loker['title']);
            $sheet->setCellValue('B' . $row, $loker['kualifikasi']);
            $sheet->setCellValue('C' . $row, $loker['corporate_name']);
            $sheet->setCellValue('D' . $row, $loker['corporate_contact']);
            $sheet->setCellValue('E' . $row, $loker['expired_date']);
        }

        ob_end_clean();

        if ($fileformat == "csv") {

        } else if ($fileformat == "xlsx") {
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Cache-Control: max-age=0');
            header('Content-Disposition: attachment;filename=Data Alumni.xlsx');
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
            exit();
        }
    }

    public function trash() {
        $data_id = $this->request->getPost('id');
        $paksa  = $this->request->getPost('paksa');
        $deleted = $this->lokerModel->trashData($data_id, $paksa);

        if ($deleted) {
            $this->session->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            $this->session->setFlashdata('error', 'Data gagal dihapus');
        }

        return redirect()->back();
    }
}
