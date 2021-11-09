$('#change_password').on('click', function () {
    if ($(this).is(":checked")) {
        $('#section-password').removeClass('d-none');
    } else {
        $('#section-password').addClass('d-none');
    }
});
