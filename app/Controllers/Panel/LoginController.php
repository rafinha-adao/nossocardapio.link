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
            ->select('users.uuid, users.name, users.email, users.password, users.image_path, users.active, establishments.id as establishment_id, establishments.name as establishment_name, establishments.active as establishment_active')
            ->join('establishments', 'establishments.id = users.establishment_id')
            ->where('users.email', $data['email'])
            ->first();

        if (!$user || !$user['active'] || !password_verify($data['password'], $user['password']) || !$user['establishment_active']) {
            return redirect()->back()->with('error', 'E-mail e/ou senha inválidos.');
        }

        unset($user['password']);

        session()->set('user', $user);

        return redirect()->to(session('intended_uri') ?? '/');
    }

    public function destroy()
    {
        session()->destroy();

        return redirect()->to('entrar');
    }
}
