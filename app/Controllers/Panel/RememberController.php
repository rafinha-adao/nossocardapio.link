<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\User;
use Config\Services;

class RememberController extends BaseController
{
    private $user_model;

    public function __construct()
    {
        $this->user_model = model(User::class);
    }

    public function index()
    {
        return view('panel/pages/remember/index', [
            'title' => 'Esqueci minha senha'
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
            ]
        ]);

        if (!$validated) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $email = $this->request->getPost('email');
        $user  = $this->user_model->select('email')->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'E-mail inválido');
        }

        $remember_token = bin2hex(random_bytes(32));

        $this->user_model->where('email', $email)->set([
            'remember_token' => $remember_token
        ])->update();

        $email_service = Services::email();
        $email_service->setTo($email);
        $email_service->setSubject('Esqueci minha senha');
        $email_service->setMessage('<a href="' . base_url('esqueci-minha-senha/' . $remember_token) . '">Alterar minha senha</a>');

        if (!$email_service->send()) {
            return redirect()->back()->with('error', 'Erro ao enviar e-mail.');
        }

        return redirect()->back()->with('success', 'E-mail enviado com sucesso!');
    }

    public function edit($remember_token)
    {
        $user = $this->user_model->select('remember_token')->where('remember_token', $remember_token)->first();

        if (!$user) {
            return redirect()->to('painel/esqueci-minha-senha/')->with('error', 'Token expirado');
        }

        return view('panel/pages/remember/edit', [
            'title'          => 'Alterar minha senha',
            'remember_token' => $remember_token
        ]);
    }

    public function update($remember_token)
    {
        $validated = $this->validate([
            'password' => [
                'label' => 'senha',
                'rules' => [
                    'required'
                ]
            ],
            'confirm_password' => [
                'label' => 'confirmação de senha',
                'rules' => [
                    'required_with[password]',
                    'matches[password]'
                ]
            ]
        ]);

        $data = $this->request->getPost();

        if (!$validated) {
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        $user = $this->user_model
            ->select('users.uuid, users.name, users.email, users.image_path, users.active, establishments.id as establishment_id, establishments.name as establishment_name, establishments.active as establishment_active')
            ->join('establishments', 'establishments.id = users.establishment_id')
            ->where('users.remember_token', $remember_token)
            ->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Erro ao encontrar usuário.')->withInput();
        }

        model(User::class)
            ->where('uuid', $user['uuid'])
            ->set([
                'password'       => password_hash($data['password'], PASSWORD_DEFAULT),
                'remember_token' => null
            ])
            ->update();

        session()->set('user', $user);

        return redirect()->to('painel')->with('success', 'Senha alterada com sucesso!');
    }
}
