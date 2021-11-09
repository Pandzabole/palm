<script>
    $(document).ready(function () {
        $('.publish-button').on('click', function (e) {
            e.preventDefault();
            let button = $(this);
            button.addClass('disabled');

            Swal.fire({
                title: 'Are you sure you want to publish changes?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonColor: '#B70024',
                cancelButtonColor: '#1A3024',
                confirmButtonText: 'Yes, publish!',
                cancelButtonText: "No, cancel",
                reverseButtons: true
            }).then((result) => {
                // if you click cancel, escape, close, click outside modal.. -> abort action
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top',
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                if (result.dismiss) {
                    button.removeClass('disabled');
                    Toast.fire({
                        icon: 'error',
                        title: 'Publish canceled.'
                    })
                } else {
                    // if you agree, to publish
                    button.html('Publishing...');
                    $.ajax({
                        url: "{{ route('publish') }}",
                        complete: function (xhr) {
                            button.removeClass('disabled');
                            button.html('Publish');
                            if (xhr.status === 201) {
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Published successfully.'
                                })
                                $('.publish-button').addClass('d-none');
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: 'Publish canceled.'
                                })
                            }
                        }
                    })
                }
            })
        })
    });
</script>

@yield('js-scripts')
