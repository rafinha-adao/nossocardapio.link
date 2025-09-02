<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Config\Services;

class LoginController extends BaseController
{
    public function index()
    {
        return view('admin/pages/login/index', [
            'title' => 'Entrar no administrador'
        ]);
    }

    public function store()
    {
        $validated = $this->validate([
            'email' => [
                'label' => 'e-mail',
                'rules' => [
                    'required'
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

        if ($data['email'] !== env('admin.email') && $data['password'] !== env('admin.password')) {
            return redirect()->back()->with('error', 'E-mail e/ou senha inválidos.');
        }

        $encrypter = Services::encrypter();

        session()->set('admin_user', $encrypter->encrypt($data['password']));

        return redirect()->to(session('admin_intended_uri') ?? 'administrador');
    }

    public function destroy()
    {
        session()->remove('admin_user');

        return redirect()->to('administrador/entrar');
    }
}
