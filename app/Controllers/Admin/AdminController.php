<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
    public function index()
    {
        return redirect()->to('administracao/estabelecimentos/adicionar');
    }
}
