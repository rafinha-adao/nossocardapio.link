<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use FPDF;

class GeneratePdfController extends BaseController
{
    public function index()
    {
        return view('panel/pages/generate-pdf/index', [
            'title' => 'Gerar PDF'
        ]);
    }

    public function store()
    {
        $validated = $this->validate([
            'images[]' => [
                'label' => 'Imagens',
                'rules' => [
                    'is_image[images[]]',
                ]
            ]
        ]);

        if (!$validated) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $files = $this->request->getFiles();

        $max_total_size = 20 * 1024 * 1024;
        $total_size     = 0;

        $pdf = new FPDF('P', 'pt');
        $pdf->SetAutoPageBreak(false);

        foreach ($files['images'] as $file) {
            if ($file->isValid()) {
                $total_size += $file->getSize();
                if ($total_size > $max_total_size) {
                    return redirect()->back()->with('errors', [
                        'images[]' => 'O total das imagens não pode exceder 20MB.'
                    ]);
                }

                $image  = imagecreatefromstring(file_get_contents($file->getTempName()));
                $width  = imagesx($image);
                $height = imagesy($image);

                $new_width  = $width * 0.5;
                $new_height = $height * 0.5;
                $thumb      = imagecreatetruecolor($new_width, $new_height);

                imagecopyresampled($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

                ob_start();
                imagejpeg($thumb, null, 75);
                $image_data = ob_get_clean();

                imagedestroy($image);
                imagedestroy($thumb);

                $tmp_file = tempnam(sys_get_temp_dir(), 'image_') . '.jpg';
                file_put_contents($tmp_file, $image_data);

                $pdf->AddPage('P', [$new_width, $new_height]);
                $pdf->Image($tmp_file, 0, 0, $new_width, $new_height);

                unlink($tmp_file);
            }
        }

        $pdf->Output('D', uniqid() . '.pdf');
        exit;
    }
}
