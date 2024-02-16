<script>
    const imageInput = document.getElementById("{{$imageId}}");
    const imagePreview = document.getElementById("{{$imgPreviewId}}");

    imageInput.addEventListener('change', function (event) {
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        } else {
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
        }
    });

</script>
