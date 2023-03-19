$('input[name="image"]').on('change', function () {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('.image-input-preview').css('background-image', 'url(' + e.target.result + ')');
    }
    reader.readAsDataURL(this.files[0]);
});
$('input[name="remove_image"]').on('change', function () {
    $('.image-input-preview').css('background-image', 'url(assets/images/placeholder.jpg)');
});

