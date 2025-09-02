<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\User;

class LoginController extends BaseController
{
    private $user_model;

    public function __construct()
    {
        $this->user_model = model(User::class);
    }

    public function index()
    {
        return view('panel/pages/login/index', [
            'title' => 'Entrar no painel'
        ]);
    }

    public function store()
    {
        $validated = $this->validate([
            'email' => [
                'label' => 'e-mail',
                'rules' => [
                    'required',
                    'valid_email',
                    'max_length[255]'
                ]
            ],
            'password' => [
                'label' => 'senha',
                'rules' => [
                    'required'
                ]
            ]
        ]);

        if (!$validated) {
            return redirect()->back()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost();

        $user = $this->user_model
            ->select('users.uuid, users.name, users.email, users.password, users.active, establishments.id as establishment_id, establishments.uuid as establishment_uuid, establishments.name as establishment_name, establishments.slug as establishment_slug, establishments.active as establishment_active, establishments.created_at as establishment_created_at, menus.id as menu_id, menus.uuid as menu_uuid')
            ->join('establishments', 'establishments.id = users.establishment_id')
            ->join('menus', 'menus.establishment_id = users.establishment_id')
            ->where('users.email', $data['email'])
            ->where('users.active', 1)
            ->where('establishments.active', 1)
            ->first();

        if (!$user || !password_verify($data['password'], $user['password'])) {
            return redirect()->back()->with('error', 'E-mail e/ou senha inválidos.');
        }

        unset($user['password']);

        session()->set('user', $user);

        return redirect()->to(session('intended_uri') ?? 'painel');
    }

    public function destroy()
    {
        session()->remove('user');

        return redirect()->to('painel/entrar');
    }
}
