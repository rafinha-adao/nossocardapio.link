<?= $this->extend('panel/layout') ?>

<?= $this->section('content') ?>
<div class="row g-0 gap-2 mb-2">
    <div class="col-md">
        <a class="btn btn-light border btn-lg p-3 w-100 text-start" href="<?= base_url('painel/cardapios/' . $menu_uuid) ?>" role="button">
            <div class="d-flex flex-column gap-1">
                <i class="bi bi-book fs-2"></i>
                <span>
                    Ver cardápio
                </span>
            </div>
        </a>
    </div>
    <div class="col-md">
        <button type="button" class="btn btn-light border btn-lg p-3 w-100 text-start" onclick="copyToClipboard(this, '<?= $establishment_link ?>')">
            <div class="d-flex flex-column gap-1">
                <i class="bi bi-link-45deg fs-2"></i>
                <span>
                    Copiar link
                </span>
            </div>
        </button>
    </div>
</div>
<div class="row g-0 gap-2 mb-2">
    <div class="col-md">
        <a class="btn btn-light border btn-lg p-3 w-100 text-start" href="<?= base_url('painel/gerar-qrcode') ?>" role="button">
            <div class="d-flex flex-column gap-1">
                <i class="bi bi-qr-code fs-2"></i>
                <span>
                    Gerar QRcode
                </span>
            </div>
        </a>
    </div>
    <div class="col-md">
        <a class="btn btn-light border btn-lg p-3 w-100 text-start" href="<?= base_url('painel/gerar-pdf') ?>" role="button">
            <div class="d-flex flex-column gap-1">
                <i class="bi bi-filetype-pdf fs-2"></i>
                <span>
                    Gerar PDF
                </span>
            </div>
        </a>
    </div>
</div>
<div class="row g-0 gap-2 mb-2">
    <div class="col-md">
        <a class="btn btn-light border btn-lg p-3 w-100 text-start" href="<?= base_url('painel/meu-estabelecimento') ?>" role="button">
            <div class="d-flex flex-column gap-1">
                <i class="bi bi-shop fs-2"></i>
                <span>
                    Meu estabelecimento
                </span>
            </div>
        </a>
    </div>
    <div class="col-md">
        <a class="btn btn-light border btn-lg p-3 w-100 text-start" href="https://wa.me/5519995827504?text=Oi, tudo bem? preciso de ajuda no Nosso Cardápio" target="_blank" role="button" onclick="return confirm('Deseja mesmo abrir o WhatsApp?')">
            <div class="d-flex flex-column gap-1">
                <i class="bi bi-question-circle fs-2"></i>
                <span>
                    Preciso de ajuda
                </span>
            </div>
        </a>
    </div>
</div>
<?= $this->endSection('content') ?>