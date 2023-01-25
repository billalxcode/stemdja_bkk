<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\AlumniModel;
use App\Models\UsersModel;

class Alumni extends BaseController
{
    protected $alumniModel;
    protected $userModel;

    function __construct()
    {
        $this->alumniModel = new AlumniModel();
        $this->userModel = new UsersModel();
    }

    public function get_all()
    {
        $dataAlumni = $this->alumniModel->getAllData("public");

        $data = [
            'status' => true,
            'data' => $dataAlumni,
        ];

        return $this->response->setJSON($data)->setStatusCode(200);
    }

    public function find_alumni() {
        $user_id = $this->request->getPost("user_id");
        
        if (isset($user_id)) {
            $alumnidata = $this->alumniModel->select('user_id')->where('id', $user_id)->first();
            if ($alumnidata) {
                // echo var_dump($alumnidata);
                $userdata = $this->userModel->select('name')->where('id', $alumnidata['user_id'])->first();
                foreach ($userdata as $key => $val) {
                    $alumnidata[$key] = $val;
                }

                $this->context['status'] = true;
                $this->context['data'] = $alumnidata;
            } else {
                $this->context['status'] = false;
                $this->context['message'] = 'Maaf data tidak dapat ditemukan';
            }
        } else {
            $this->context['status'] = false;
            $this->context['message'] = 'Maaf data tidak dapat ditemukan';
        }

        return $this->response->setJSON($this->context)->setStatusCode(200);
    }
}
