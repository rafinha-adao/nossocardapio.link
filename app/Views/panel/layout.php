<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Nosso Cardápio</title>
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body class="<?= url_is('painel/entrar') || url_is('painel/esqueci-minha-senha*') ? 'bg-light' : 'bg-white' ?>">
    <?php if (url_is('painel/entrar') || url_is('painel/esqueci-minha-senha*')) : ?>
        <?= $this->renderSection('content') ?>
    <?php else : ?>
        <header class="border-bottom px-3 py-2 bg-light text-bg-light">
            <nav class="d-flex justify-content-between align-items-center">
                <a class="navbar-brand fw-semibold" href="<?= base_url('painel') ?>">
                    Nosso Cardápio
                </a>
                <form action="<?= base_url('painel/sair') ?>" method="POST" onsubmit="return confirm('Deseja mesmo sair do painel?')">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-light" data-bs-toggle="tooltip" data-bs-title="Sair do painel">
                        <i class="bi bi-box-arrow-in-right fs-4"></i>
                    </button>
                </form>
            </nav>
        </header>
        <main class="container-fluid d-flex align-items-center justify-content-center p-3">
            <div style="max-width: 500px; width: 100%;">
                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session('success') ?>
                    </div>
                <?php endif ?>
                <?php if (session()->has('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= session('error') ?>
                    </div>
                <?php endif ?>
                <h1 class="h2 mb-3"><?= $title ?></h1>
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    <?php endif ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/js/index.js') ?>"></script>
</body>