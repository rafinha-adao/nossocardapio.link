<?= $this->extend('panel/layout') ?>

<?= $this->section('content') ?>
<?php if ($file) : ?>
    <iframe src="<?= base_url($file['path']) ?>" class="border rounded w-100 mb-3" height="500"></iframe>
<?php else : ?>
    <p class="mb-3">Cardápio vazio. Edite e envie um arquivo PDF.</p>
<?php endif ?>
<div class="d-flex gap-2">
    <a class="btn btn-light border btn-lg w-100" href="<?= base_url('painel') ?>" role="button">
        Voltar
    </a>
    <a class="btn btn-dark btn-lg w-100" href="<?= base_url('painel/cardapios/' . $menu_uuid . '/editar') ?>" role="button">
        Editar
    </a>
</div>
<?= $this->endSection('content') ?>