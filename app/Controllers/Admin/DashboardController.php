<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function dashboard()
    {
        return $this->render('admin/dashboard');
    }
}
