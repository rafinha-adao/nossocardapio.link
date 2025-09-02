<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Establishment;
use App\Models\File;
use App\Models\Menu;
use App\Models\User;
use Ramsey\Uuid\Uuid;

class EstablishmentController extends BaseController
{
    private $establishment_model;
    private $user_model;
    private $menu_model;
    private $file_model;

    public function __construct()
    {
        $this->establishment_model = model(Establishment::class);
        $this->user_model          = model(User::class);
        $this->menu_model          = model(Menu::class);
        $this->file_model          = model(File::class);
    }

    public function create()
    {
        return view('admin/pages/establishment/create', [
            'title' => 'Adicionar estabelecimento'
        ]);
    }

    public function store()
    {
        $validated = $this->validate([
            'establishment_name' => [
                'label' => 'nome do estabelecimento',
                'rules' => [
                    'required',
                    'max_length[100]'
                ]
            ],
            'establishment_description' => [
                'label' => 'descrição do estabelecimento',
                'rules' => [
                    'max_length[255]'
                ]
            ],
            'user_name' => [
                'label' => 'nome do usuário',
                'rules' => [
                    'required',
                    'max_length[100]'
                ]
            ],
            'user_email' => [
                'label' => 'e-mail do usuário',
                'rules' => [
                    'required',
                    'valid_email',
                    'max_length[255]',
                    'is_unique[users.email]'
                ]
            ],
            'user_password' => [
                'label' => 'senha do usuário',
                'rules' => [
                    'required'
                ]
            ],
            'confirm_user_password' => [
                'label' => 'confirmação de senha do usuário',
                'rules' => [
                    'required',
                    'matches[user_password]'
                ]
            ],
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

        $data = $this->request->getPost();

        $establishment = $this->establishment_model->insert([
            'uuid'        => Uuid::uuid4()->toString(),
            'slug'        => url_title($data['establishment_name'], '-', true),
            'name'        => $data['establishment_name'],
            'description' => $data['establishment_description'] ?? null
        ]);

        $this->user_model->insert([
            'uuid'             => Uuid::uuid4()->toString(),
            'establishment_id' => $establishment,
            'name'             => $data['user_name'],
            'email'            => $data['user_email'],
            'password'         => password_hash($data['user_password'], PASSWORD_DEFAULT)
        ]);

        $menu = $this->menu_model->insert([
            'uuid'             => Uuid::uuid4()->toString(),
            'establishment_id' => $establishment,
            'name'             => 'Cardápio ' . $data['establishment_name']
        ]);

        $file = $this->request->getFile('file');

        if ($file->isValid() && !$file->hasMoved()) {
            $file_name        = $file->getClientName();
            $file_stored_name = $file->getRandomName();
            $file_path        = 'files/' . $file_stored_name;
            $file_mime_type   = $file->getMimeType();
            $file_extension   = $file->guessExtension();
            $file_size        = $file->getSize();

            $file->move(FCPATH . 'files', $file_stored_name);

            $this->file_model->insert([
                'uuid'        => Uuid::uuid4()->toString(),
                'menu_id'     => $menu,
                'name'        => $file_name,
                'stored_name' => $file_stored_name,
                'path'        => $file_path,
                'mime_type'   => $file_mime_type,
                'extension'   => $file_extension,
                'size'        => $file_size
            ]);
        }

        return redirect()->back()->with('success', 'Estabelecimento adicionado com sucesso!');
    }
}
