<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Establishment;
use App\Models\File;
use App\Models\Menu;
use FPDF;

class EstablishmentController extends BaseController
{
    private $establishment_model;
    private $menu_model;
    private $file_model;

    public function __construct()
    {
        $this->establishment_model = model(Establishment::class);
        $this->menu_model          = model(Menu::class);
        $this->file_model          = model(File::class);
    }

    public function show($slug)
    {
        $file = $this->file_model
            ->select('files.*, menus.name as menu_name')
            ->join('menus', 'menus.id = files.menu_id')
            ->join('establishments', 'establishments.id = menus.establishment_id')
            ->where('establishments.slug', $slug)
            ->first();

        if (!$file) {
            return redirect()->to('/');
        }

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline;')
            ->setBody(file_get_contents($file['path']));
    }
}
