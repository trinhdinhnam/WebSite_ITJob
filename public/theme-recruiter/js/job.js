    $(function() {
        $(".btn-delete").click(function(event) {
            event.preventDefault();
            $("#confirmDelete").modal('show');
        });
        $('#confirmLogin').on('hidden.bs.modal', function(e) {
            location.reload();
        });
    })
