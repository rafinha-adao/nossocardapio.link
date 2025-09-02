<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<form action="<?= base_url('administracao/estabelecimentos/adicionar') ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="inputEstablishmentName" class="form-label">
            Nome do estabelecimento
        </label>
        <input type="text" name="establishment_name" class="<?= isset(session('errors')['establishment_name']) ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg' ?>" id="inputEstablishmentName" placeholder="Insira o nome do estabelecimento" maxlength="100">
        <div class="invalid-feedback"><?= session('errors')['establishment_name'] ?? '' ?></div>
    </div>
    <div class="mb-3">
        <label for="inputEstablishmentDescription" class="form-label">
            Descrição
        </label>
        <textarea name="establishment_description" class="<?= isset(session('errors')['email']) ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg' ?>" id="inputEstablishmentDescription" maxlength="255" placeholder="Insira a descrição do estabelecimento"></textarea>
        <div class="invalid-feedback"><?= session('errors')['email'] ?? '' ?></div>
    </div>
    <div class="mb-3">
        <label for="inputUserName" class="form-label">
            Nome do usuário
        </label>
        <input type="text" name="user_name" class="<?= isset(session('errors')['user_name']) ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg' ?>" id="inputUserName" placeholder="Insira o nome do usuário" maxlength="100">
        <div class="invalid-feedback"><?= session('errors')['user_name'] ?? '' ?></div>
    </div>
    <div class="mb-3">
        <label for="inputUserEmail" class="form-label">
            E-mail do usuário
        </label>
        <input type="email" name="user_email" class="<?= isset(session('errors')['user_email']) ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg' ?>" id="inputUserEmail" placeholder="Insira o e-mail do usuário" maxlength="255">
        <div class="invalid-feedback"><?= session('errors')['user_email'] ?? '' ?></div>
    </div>
    <div class="mb-3">
        <label for="inputUserPassword" class="form-label">
            Senha do usuário
        </label>
        <input type="password" name="user_password" class="<?= isset(session('errors')['user_password']) ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg' ?>" id="inputUserPassword" placeholder="Insira uma senha para o usuário" maxlength="255">
        <div class="invalid-feedback"><?= session('errors')['user_password'] ?? '' ?></div>
    </div>
    <div class="mb-3">
        <label for="inputConfirmUserPassword" class="form-label">
            Confirme a senha
        </label>
        <input type="password" name="confirm_user_password" class="<?= isset(session('errors')['confirm_user_password']) ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg' ?>" id="inputConfirmUserPassword" placeholder="Confirme a senha do usuário" maxlength="255">
        <div class="invalid-feedback"><?= session('errors')['confirm_user_password'] ?? '' ?></div>
    </div>
    <div class="mb-3">
        <label for="imagesInput" class="form-label">
            Selecione um arquivo PDF
        </label>
        <input type="file" name="file" class="<?= isset(session('errors')['file']) ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg' ?>" id="fileInput" accept=".pdf">
        <div class="invalid-feedback"><?= session('errors')['file'] ?? '' ?></div>
    </div>
    <div class="d-flex gap-2">
        <a class="btn btn-light border btn-lg w-100 d-none" href="<?= base_url('administracao/estabelecimentos') ?>" role="button">
            Voltar
        </a>
        <button type="submit" class="btn btn-dark btn-lg w-100">
            Adicionar
        </button>
    </div>
</form>
<?= $this->endSection('content') ?>