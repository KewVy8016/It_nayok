$(document).ready(function() {

    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('image-upload');
    const preview = document.getElementById('image-preview');
    const dropText = document.getElementById('drop-zone-text');

    dropZone.addEventListener('click', () => fileInput.click());

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-primary');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-primary');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-primary');
        fileInput.files = e.dataTransfer.files;
        displayPreview(e.dataTransfer.files[0]);
    });

    fileInput.addEventListener('change', (e) => {
        displayPreview(e.target.files[0]);
    });

    function displayPreview(file) {
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.style.display = 'block';
                dropText.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    }
});