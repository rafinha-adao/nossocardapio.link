<?= $this->extend('panel/layout') ?>

<?= $this->section('content') ?>
<main class="container-fluid d-flex flex-column align-items-center justify-content-center min-vh-100 h-100">
    <div class="card p-4 col-md-6 col-lg-4 col-12 w-100" style="max-width: 500px;">
        <h1 class="h2 mb-3">
            <?= $title ?>
        </h1>
        <form action="<?= base_url('painel/esqueci-minha-senha/' . $remember_token) ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success fade show" role="alert">
                    <?= session('success') ?>
                </div>
            <?php endif ?>
            <?php if (session()->has('error')) : ?>
                <div class="alert alert-danger fade show" role="alert">
                    <?= session('error') ?>
                </div>
            <?php endif ?>
            <div class="mb-3">
                <label for="inputPassword" class="form-label">
                    Nova senha
                </label>
                <input type="password" name="password" class="<?= isset(session('errors')['password']) ? 'form-control is-invalid' : 'form-control' ?>" id="inputPassword" placeholder="Insira uma nova senha">
                <div class="invalid-feedback"><?= session('errors')['password'] ?? '' ?></div>
            </div>
            <div class="mb-4">
                <label for="inputConfirmPassword" class="form-label">
                    Confirmar nova senha
                </label>
                <input type="password" name="confirm_password" class="<?= isset(session('errors')['confirm_password']) ? 'form-control is-invalid' : 'form-control' ?>" id="inputConfirmPassword" placeholder="Confirme a nova senha">
                <div class="invalid-feedback"><?= session('errors')['confirm_password'] ?? '' ?></div>
            </div>
            <button type="submit" class="btn btn-dark btn-lg w-100">
                Alterar
            </button>
        </form>
    </div>
</main>
<?= $this->endSection('content') ?>