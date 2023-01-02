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
        'title', 'corporate_name', 'corporate_contact', 'expired_date', 'pendidikan',
        'tipe_pekerjaan', 'lokasi', 'range_gaji', 'deskripsi'
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

    public function create_data($title, $corporate_name, $corporate_contact, $expired_date, $pendidikan, $tipe_pekerjaan, $provinsi, $kota, $deskripsi) {
        return [
            'title'             => $title,
            'corporate_name'    => $corporate_name,
            'corporate_contact' => $corporate_contact,
            'expired_date'      => $expired_date,
            'pendidikan'        => $pendidikan,
            'tipe_pekerjaan'    => $tipe_pekerjaan,
            'provinsi'          => $provinsi,
            'kota'              => $kota,
            'range_gaji'        => null,
            'deskripsi'         => htmlspecialchars($deskripsi)
        ];
    }

    public function get_all_data() {
        $data = $this->select('id,title,corporate_name,corporate_contact,expired_date,deskripsi,created_at')->findAll();

        return $data;
    }

    public function trashData($data_id, $paksa) {
        return $this->delete($data_id, ($paksa == 'ya' ? true : false));
    }

    public function find_loker($search) {
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
            
            // $qr_uri = $qrcode->uri
            $loker['loker_uri'] = base_url('alumni/loker/' . $loker['id']);
            $loker['loker_qr_uri'] = $result->getDataUri();
            array_push($lokerData_real, $loker);
        }

        return $lokerData_real;
    }
}
