$(function() {
    $(".btn-invalid").click(function(event) {
        event.preventDefault();
        $("#confirmRegisterService").modal('show');
    });
    $('#confirmRegisterService').on('hidden.bs.modal', function(e) {
        location.reload();
    });
})
