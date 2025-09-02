<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class GenerateQRcodeController extends BaseController
{
    private $establishment_slug;

    public function __construct()
    {
        $this->establishment_slug = session('user')['establishment_slug'];
    }

    public function index()
    {
        $qrcode = (new QRCode(
            new QROptions([
                'outputType' => 'png',
                'scale'      => 8
            ])
        ))->render(base_url($this->establishment_slug));

        return view('panel/pages/generate-qrcode/index', [
            'title'  => 'Gerar QRcode',
            'qrcode' => $qrcode
        ]);
    }
}
