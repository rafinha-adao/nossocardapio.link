<?= $this->extend('panel/layout') ?>

<?= $this->section('content') ?>
<form action="<?= base_url('painel/gerar-pdf') ?>" method="POST" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label for="imagesInput" class="form-label">Selecione as imagens</label>
        <input class="<?= isset(session('errors')['images[]']) ? 'form-control form-control-lg is-invalid' : 'form-control form-control-lg' ?>" type="file" id="imagesInput" name="images[]" multiple accept="image/*">
        <div class="invalid-feedback"><?= session('errors')['images[]'] ?? 'images[]' ?></div>
    </div>
    <div class="d-flex gap-2">
        <a class="btn btn-light border btn-lg w-100" href="<?= base_url('painel') ?>" role="button">
            Voltar
        </a>
        <button type="submit" class="btn btn-dark btn-lg w-100">
            Gerar
        </button>
    </div>
</form>
<?= $this->endSection('content') ?>