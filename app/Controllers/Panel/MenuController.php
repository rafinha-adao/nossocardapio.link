<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\File;
use Ramsey\Uuid\Uuid;

class MenuController extends BaseController
{
    private $menu_id;
    private $menu_uuid;
    private $file_model;
    private $file;

    public function __construct()
    {
        $this->menu_id    = session('user')['menu_id'];
        $this->menu_uuid  = session('user')['menu_uuid'];
        $this->file_model = model(File::class);
        $this->file       = $this->file_model->where('menu_id', $this->menu_id)->first();
    }

    public function show()
    {
        return view('panel/pages/menu/show', [
            'title'     => 'Ver cardápio',
            'menu_uuid' => $this->menu_uuid,
            'file'      => $this->file
        ]);
    }

    public function edit($uuid)
    {
        if ($this->menu_uuid !== $uuid) {
            return redirect()->to('painel');
        }

        return view('panel/pages/menu/edit', [
            'title'     => 'Editar cardápio',
            'menu_uuid' => $this->menu_uuid,
            'file'      => $this->file
        ]);
    }

    public function update()
    {
        $validated = $this->validate([
            'file' => [
                'label' => 'arquivo',
                'rules' => [
                    'uploaded[file]',
                    'ext_in[file,pdf]',
                    'mime_in[file,application/pdf]',
                    'max_size[file,20480]'
                ]
            ]
        ]);

        if (!$validated) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        if ($this->file) {
            $file_path = FCPATH . 'files/' . $this->file['stored_name'];

            if (is_file($file_path)) {
                unlink($file_path);
            }

            $this->file_model->delete($this->file['id']);
        }

        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            $name        = $file->getClientName();
            $stored_name = $file->getRandomName();
            $path        = 'files/' . $stored_name;
            $mime_type   = $file->getMimeType();
            $extension   = $file->guessExtension();
            $size        = $file->getSize();

            $file->move(FCPATH . 'files', $stored_name);

            $this->file_model->insert([
                'uuid'        => Uuid::uuid4()->toString(),
                'menu_id'     => $this->menu_id,
                'name'        => $name,
                'stored_name' => $stored_name,
                'path'        => $path,
                'mime_type'   => $mime_type,
                'extension'   => $extension,
                'size'        => $size
            ]);

            return redirect()->to('painel/cardapios/' . $this->menu_uuid)->with('success', 'Arquivo enviado com sucesso!');
        }

        return redirect()->back()->with('errors', 'Falha no upload do arquivo.');
    }
}
