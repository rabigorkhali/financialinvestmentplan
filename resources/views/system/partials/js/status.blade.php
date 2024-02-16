<script>
    function openStatusModal(url) {
        $('#statusForm').attr('action', url);
        $('#statusChangeModal').modal('show');
    }

    // Attach a click event to your delete buttons
    $('.update-button').on('click', function () {
        const statusUpdateUrl = $(this).data('update-url');
        openStatusModal(statusUpdateUrl);
    });

</script>
