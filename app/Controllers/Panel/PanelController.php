<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;

class PanelController extends BaseController
{
    private $establishment_slug;
    private $menu_uuid;

    public function __construct()
    {
        $this->establishment_slug = session('user')['establishment_slug'];
        $this->menu_uuid          = session('user')['menu_uuid'];
    }

    public function index()
    {
        return view('panel/pages/index', [
            'title'              => 'Painel',
            'menu_uuid'          => $this->menu_uuid,
            'establishment_link' => base_url($this->establishment_slug)
        ]);
    }
}
