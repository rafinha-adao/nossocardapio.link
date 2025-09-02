<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<main class="container-fluid d-flex flex-column align-items-center justify-content-center min-vh-100 h-100">
    <div class="card p-4 col-md-6 col-lg-4 col-12 w-100" style="max-width: 500px;">
        <h1 class="h2 mb-3"><?= $title ?></h1>
        <form action="<?= base_url('administrador/entrar') ?>" method="POST">
            <?= csrf_field() ?>
            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger fade show" role="alert">
                    <?= session('error') ?>
                </div>
            <?php endif ?>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">
                    E-mail
                </label>
                <input type="text" name="email" class="<?= isset(session('errors')['email']) ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg' ?>" id="inputEmail" placeholder="Insira seu e-mail" maxlength="255">
                <div class="invalid-feedback"><?= session('errors')['email'] ?? '' ?></div>
            </div>
            <div class="mb-4">
                <label for="inputPassword" class="form-label">
                    Senha
                </label>
                <input type="password" name="password" class="<?= isset(session('errors')['password']) ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg' ?>" id="inputPassword" placeholder="Insira sua senha">
                <div class="invalid-feedback"><?= session('errors')['password'] ?? '' ?></div>
            </div>
            <button type="submit" class="btn btn-dark btn-lg w-100">
                Entrar
            </button>
        </form>
    </div>
</main>
<?= $this->endSection('content') ?>