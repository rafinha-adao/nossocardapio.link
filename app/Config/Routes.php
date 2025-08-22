<?php

use App\Controllers\Panel\LoginController as PanelLoginController;
use App\Controllers\Panel\MenuController as PanelMenuController;
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
    $routes->get('cardapios', [PanelMenuController::class, 'index']);
    $routes->get('cardapios/adicionar', [PanelMenuController::class, 'create']);
    $routes->post('cardapios/adicionar', [PanelMenuController::class, 'store']);
    $routes->get('cardapios/(:hash)/editar', [PanelMenuController::class, 'edit']);
    $routes->put('cardapios/(:hash)/editar', [PanelMenuController::class, 'update']);
    $routes->delete('cardapios/(:hash)/remover', [PanelMenuController::class, 'destroy']);

    $routes->delete('sair', [PanelLoginController::class, 'destroy']);
});

$routes->get('(:hash)', function () {
    //
});
