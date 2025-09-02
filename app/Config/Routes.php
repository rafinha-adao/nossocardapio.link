<?php

use App\Controllers\Admin\AdminController;
use App\Controllers\Admin\EstablishmentController as AdminEstablishmentController;
use App\Controllers\Admin\LoginController as AdminLoginController;
use App\Controllers\EstablishmentController;
use App\Controllers\Panel\EstablishmentController as PanelEstablishmentController;
use App\Controllers\Panel\GeneratePdfController as PanelGeneratePdfController;
use App\Controllers\Panel\GenerateQRcodeController as PanelGenerateQRcodeController;
use App\Controllers\Panel\LoginController as PanelLoginController;
use App\Controllers\Panel\MenuController as PanelMenuController;
use App\Controllers\Panel\PanelController;
use App\Controllers\Panel\RememberController as PanelRememberController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('painel', ['filter' => 'reversepanel'], static function ($routes) {
    $routes->get('entrar', [PanelLoginController::class, 'index']);
    $routes->post('entrar', [PanelLoginController::class, 'store']);

    $routes->get('esqueci-minha-senha', [PanelRememberController::class, 'index']);
    $routes->post('esqueci-minha-senha', [PanelRememberController::class, 'store']);
    $routes->get('esqueci-minha-senha/(:hash)', [PanelRememberController::class, 'edit']);
    $routes->put('esqueci-minha-senha/(:hash)', [PanelRememberController::class, 'update']);
});

$routes->group('painel', ['filter' => 'panel'], static function ($routes) {
    $routes->get('/', [PanelController::class, 'index']);

    $routes->get('cardapios/(:hash)', [PanelMenuController::class, 'show']);
    $routes->get('cardapios/(:hash)/editar', [PanelMenuController::class, 'edit']);
    $routes->put('cardapios/(:hash)/editar', [PanelMenuController::class, 'update']);

    $routes->get('gerar-qrcode', [PanelGenerateQRcodeController::class, 'index']);

    $routes->get('gerar-pdf', [PanelGeneratePdfController::class, 'index']);
    $routes->post('gerar-pdf', [PanelGeneratePdfController::class, 'store']);

    $routes->get('meu-estabelecimento', [PanelEstablishmentController::class, 'index']);

    $routes->delete('sair', [PanelLoginController::class, 'destroy']);
});

$routes->group('administrador', ['filter' => 'reverseadmin'], static function ($routes) {
    $routes->get('entrar', [AdminLoginController::class, 'index']);
    $routes->post('entrar', [AdminLoginController::class, 'store']);
});

$routes->group('administrador', ['filter' => 'admin'], static function ($routes) {
    $routes->get('/', [AdminController::class, 'index']);

    $routes->get('estabelecimentos/adicionar', [AdminEstablishmentController::class, 'create']);
    $routes->post('estabelecimentos/adicionar', [AdminEstablishmentController::class, 'store']);

    $routes->delete('sair', [AdminLoginController::class, 'destroy']);
});

$routes->get('(:segment)', [EstablishmentController::class, 'show']);
