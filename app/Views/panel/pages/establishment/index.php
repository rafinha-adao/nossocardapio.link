<?= $this->extend('panel/layout') ?>

<?= $this->section('content') ?>
<table class="table">
    <tbody>
        <tr>
            <th scope="row">ID</th>
            <td><?= $establishment_uuid ?></td>
        </tr>
        <tr>
            <th scope="row">Nome</th>
            <td><?= $establishment_name ?></td>
        </tr>
        <tr>
            <th scope="row">Link</th>
            <td><?= $establishment_link ?></td>
        </tr>
        <tr>
            <th scope="row">Criado em</th>
            <td><?= $establishment_created_at ?></td>
        </tr>
    </tbody>
</table>
<div class="d-flex gap-2">
    <a class="btn btn-light border btn-lg w-100" href="<?= base_url('painel') ?>" role="button">
        Voltar
    </a>
    <button type="submit" class="btn btn-dark btn-lg w-100" onclick="copyToClipboard(this, '<?= $establishment_link ?>')">
        <span>Copiar link</span>
    </button>
</div>
<?= $this->endSection('content') ?>