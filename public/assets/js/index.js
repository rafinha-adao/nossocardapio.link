const tooltipTriggerList = document.querySelectorAll("[data-bs-toggle='tooltip']");
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

function copyToClipboard(btn, text) {
    if (!navigator.clipboard.writeText(text)) {
        return;
    }

    btn.querySelector("span").textContent = "Link copiado!";

    setTimeout(function () {
        btn.querySelector("span").textContent = "Copiar link";
    }, 2000);
}

if (document.getElementById("imagesInput")) {
    document.getElementById("imagesInput").addEventListener("change", function () {
        const maxSize = 20 * 1024 * 1024;
        let totalSize = 0;

        for (let file of this.files) {
            totalSize += file.size;
        }

        if (totalSize > maxSize) {
            this.value = "";
            this.nextElementSibling.textContent = "O total das imagens não pode passar de 20MB.";
            this.nextElementSibling.style.display = "block";
        } else {
            this.nextElementSibling.style.display = "none";
        }
    });
}