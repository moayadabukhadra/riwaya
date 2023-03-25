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

$('select[data-control="select2"]').on('select2:select', function (e) {
    $(this)[0].dispatchEvent(new Event('change'));
});

Livewire.hook('message.processed', (message, component) => {
    $('select[data-control="select2"]').select2();
});

