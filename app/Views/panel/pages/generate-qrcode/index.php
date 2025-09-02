<?= $this->extend('panel/layout') ?>

<?= $this->section('content') ?>
<div class="text-center">
    <img src="<?= $qrcode ?>" alt="QRcode">
</div>
<div class="d-flex gap-2">
    <a class="btn btn-light border btn-lg w-100" href="<?= base_url('painel') ?>" role="button">
        Voltar
    </a>
    <a href="<?= $qrcode ?>" download="QRcode" class="btn btn-dark btn-lg w-100" role="button">
        Baixar
    </a>
</div>
<?= $this->endSection('content') ?>