<?= $this->extend('panel/layout') ?>

<?= $this->section('content') ?>
<form action="<?= base_url('painel/cardapios/' . $menu_uuid . '/editar') ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">
    <div class="mb-3">
        <label for="imagesInput" class="form-label">
            Selecione um arquivo PDF
        </label>
        <input type="file" name="file" class="<?= isset(session('errors')['file']) ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg' ?>" id="fileInput" accept=".pdf">
        <div class="invalid-feedback"><?= session('errors')['file'] ?? '' ?></div>
    </div>
    <div class="d-flex gap-2">
        <a class="btn btn-light border btn-lg w-100" href="<?= base_url('painel/cardapios/' . $menu_uuid) ?>" role="button">
            Voltar
        </a>
        <button type="submit" class="btn btn-dark btn-lg w-100">
            Editar
        </button>
    </div>
</form>
<?= $this->endSection('content') ?>