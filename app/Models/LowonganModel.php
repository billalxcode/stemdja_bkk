<?php

namespace App\Models;

use CodeIgniter\Model;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class LowonganModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'info_lowongans';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title', 'expired_date', 'pendidikan',
        'tipe_pekerjaan', 'province_code', 'cities_code',
        'range_gaji', 'mitra_id', 'deskripsi'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function get_all_data() {
        $mitraModel = new \App\Models\MitraModel();
        $data = $this->select('id,title,mitra_id,tipe_pekerjaan,expired_date,deskripsi,created_at')->findAll();
        $data_real = [];
        foreach ($data as $row) {
            $mitraData = $mitraModel->select('name,address,site')->where('id', $row['mitra_id'])->first();
            $row['mitra'] = $mitraData;

            $data_real[] = $row;
        }

        return $data_real;
    }

    public function trashData($data_id, $paksa) {
        return $this->delete($data_id, ($paksa == 'ya' ? true : false));
    }

    public function find_loker($search) {
        $mitraModel = new \App\Models\MitraModel();
        if ($search) {
            $lokerData = $this->like('title', $search)->orLike('deskripsi', $search)->findAll();
        } else {
            $lokerData = $this->findAll();
        }

        $writer = new PngWriter();
        $label = Label::create("Scan for apply");
        $label->setTextColor(new Color(125, 122, 141));

        $lokerData_real = [];
        foreach ($lokerData as $loker) {
            $qrcode = QrCode::create(base_url('alumni/loker/' . $loker['id']));
            $qrcode->setEncoding(new Encoding('UTF-8'));
            $qrcode->setSize(300);
            $qrcode->setMargin(5);
            $qrcode->setRoundBlockSizeMode(new RoundBlockSizeModeMargin());
            $qrcode->setForegroundColor(new Color(0, 0, 0));
            $qrcode->setBackgroundColor(new Color(255, 255, 255, 0));
            $qrcode->setErrorCorrectionLevel(new ErrorCorrectionLevelLow());
            
            $result = $writer->write($qrcode, null, $label);
            $mitraData = $mitraModel->select('name,address,site')->where('id', $loker['mitra_id'])->first();
            $loker['mitra'] = $mitraData;
            $loker['loker_uri'] = base_url('alumni/loker/' . $loker['id']);
            $loker['loker_qr_uri'] = $result->getDataUri();
            array_push($lokerData_real, $loker);
        }

        return $lokerData_real;
    }

    public function get_loker_detail($loker_id) {
        $mitraModel = new \App\Models\MitraModel();

        $lokerData = $this->where('id', $loker_id)->first();
        if (!$lokerData) {
            return false;
        }

        $writer = new PngWriter();
        $label = Label::create('Scan for apply');
        $label->setTextColor(new Color(125, 122, 141));

        // Generate qrcode
        $qrcode = QrCode::create(base_url('alumni/loker/' . $loker_id));
        $qrcode->setEncoding(new Encoding('UTF-8'));
        $qrcode->setSize(300);
        $qrcode->setMargin(5);
        $qrcode->setRoundBlockSizeMode(new RoundBlockSizeModeMargin);
        $qrcode->setForegroundColor(new Color(0,0,0));
        $qrcode->setBackgroundColor(new Color(255, 255, 255, 0));
        $qrcode->setErrorCorrectionLevel(new ErrorCorrectionLevelLow());

        $result = $writer->write($qrcode, null, $label);
        $mitraData = $mitraModel->select('name,address,site')->where('id', $lokerData['mitra_id'])->first();
        $lokerData['mitra'] = $mitraData;
        $lokerData['loker_uri'] = base_url('alumni/loker/' . $loker_id);
        $lokerData['loker_qr_uri'] = $result->getDataUri();
        
        return $lokerData;
    }
}
