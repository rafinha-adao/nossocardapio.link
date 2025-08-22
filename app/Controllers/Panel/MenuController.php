<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;

class MenuController extends BaseController
{
    public function index()
    {
        return view('panel/pages/index.php');
    }
}
