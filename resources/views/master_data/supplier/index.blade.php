@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <x-create-button route="{{route('supplier.create')}}" title=Supplier />
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="supplier-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Default Markup</th>
                            <th>Number of Products</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.card -->
@endsection
@push('js')
<script>
        $(document).ready(function () {
        var table = $('#supplier-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('supplier.list')}}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'default_markup',
                    name: 'default_markup'
                },
                {
                    data: 'product_id',
                    name: 'product_id'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    width: '10%'
                },
            ]
        });

        $(document).on('click', '.btn-delete', function () {
            let id = $(this).data('id');
            url = 

            deleteConfirmation(id, table);
        })
    });

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

</script>
@endpush
