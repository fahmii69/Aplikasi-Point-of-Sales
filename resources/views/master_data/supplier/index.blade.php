@extends('layouts.master')
@section('content')
<!-- Default box -->
<div class="container-fluid">
    <div class="card shadow mb-4">
        <x-create-button route="{{ route('supplier.create') }}" title=Supplier />
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="supplier-dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Supplier Code</th>
                            <th>Supplier Name</th>
                            <th>Supplier Address</th>
                            <th>Supplier Phone</th>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        var table = $('#supplier-dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('supplier.list') }}",
            columns: [{
                    data: 'supplier_code',
                    name: 'supplier_code',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'supplier_name',
                    name: 'supplier_name',
                },
                {
                    data: 'supplier_address',
                    name: 'supplier_address',
                },
                {
                    data: 'supplier_phone',
                    name: 'supplier_phone',
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

        $(document).on('click','.btn-delete', function(){
            id = $(this).attr('data-id');

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                background: 'gray',
                timer: 5000
            });
            Swal.fire({
                // title: 'Are you sure?',
                text: "You won't be able to revert this!",
                // icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete this!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    let url = '{{ route('supplier.destroy', ':id') }}';
                        url = url.replace(':id', id);

                    $.ajax({
                        url : url,
                        type : 'delete',
                        data : {
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response){
                            if(response.status){
                                Toast.fire({
                                    // icon: 'success',
                                    title: response.message
                                });
                            }else{
                                Toast.fire({
                                    // icon: 'error',
                                    title: response.message
                                });
                            }

                            table.ajax.reload();
                        },
                        error: function(e){
                            Toast.fire({
                                // icon: 'error',
                                title: e.responseJSON.message
                            });
                        }
                    });
                }
            })
        })
    });

</script>
@endpush
