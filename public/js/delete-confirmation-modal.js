$(document).ready(function () {
    $('body').on('click', '.gl-delete-btn', function (e) {
        e.preventDefault();
        let btn = e.currentTarget;
        let form = $(btn).prev();
        Swal.fire({
            title: 'Are you sure you want to delete this?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            showCloseButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, keep it.",
            reverseButtons: true
        }).then((result) => {
            // if you click cancel, escape, close, click outside modal.. -> abort action
            if (result.dismiss) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'error',
                    title: 'Action canceled.'
                })
                return;
            }
            // if you agree, submit delete form
            form.submit();
        })
    });
});
