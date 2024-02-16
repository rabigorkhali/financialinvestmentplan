<script>
    var name = '{{ $name }}'; // This gets the value passed from Blade

    $('input[name="' + name + '"]').keyup(function (e) {
        var value = $(this).val();
        var item = {!! json_encode($item ?? '') !!};
        var slugify = convertToSlug(value);

        if (item == '') {
            $('#slug').val(slugify);
        }


    });

    function convertToSlug(str) {
        return str
            .toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '')
            .replace(/-+$/g, '')
            .replace(/--+/g, '-');
    }
</script>
