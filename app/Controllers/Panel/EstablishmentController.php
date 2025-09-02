<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;

class EstablishmentController extends BaseController
{
    private $establishment_uuid;
    private $establishment_name;
    private $establishment_slug;
    private $establishment_created_at;

    public function __construct()
    {
        $this->establishment_uuid       = session('user')['establishment_uuid'];
        $this->establishment_name       = session('user')['establishment_name'];
        $this->establishment_slug       = session('user')['establishment_slug'];
        $this->establishment_created_at = session('user')['establishment_created_at'];
    }

    public function index()
    {
        return view('panel/pages/establishment/index', [
            'title'                    => 'Meu estabelecimento',
            'establishment_uuid'       => $this->establishment_uuid,
            'establishment_name'       => $this->establishment_name,
            'establishment_link'       => base_url($this->establishment_slug),
            'establishment_created_at' => date('d/m/Y', strtotime($this->establishment_created_at))
        ]);
    }
}
