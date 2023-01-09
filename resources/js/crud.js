function deleteConfirmation(id, table) {
    swal.fire({
        title: "Hapus?",
        icon: 'question',
        text: "Kamuuuh Yakin??!!!",
        showCancelButton: !0,
        confirmButtonText: "Iya, Hapus!",
        cancelButtonText: "No, cancel!",
        reverseButtons: !0
    }).then(function (e) {
        if (e.value === true) {
            let token = $('meta[name="csrf-token"]').attr('content');
            var _url = `/supplier/${id}`;

            $.ajax({
                type: 'delete',
                url: _url,
                data: {
                    _token: token
                },
                success: function (resp) {
                    if (resp.success) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })

                        table.ajax.reload();

                        Toast.fire({
                            icon: 'success',
                            title: 'Data siswa berhasil dihapus '
                        })
                    }
                },
                error: function (resp) {
                    swal.fire("Error!", 'Something went wrong.', "error");
                }
            });

        } else {
            e.dismiss;
        }

    }, function (dismiss) {
        return false;
    })
}
