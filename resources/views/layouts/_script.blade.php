<!-- jQuery -->
<script src="{{ asset('AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('AdminLTE/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('AdminLTE/plugins/chart.js/Chart.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<!-- SweetAlert2-->
<script src="{{ asset('AdminLTE/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('AdminLTE/dist/js/demo.js') }}"></script> --}}

{{-- <script type="text/javascript">
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });

    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                Toast.fire({
                    // icon: 'info',
                    title: '{{ Session::get('message') }}'
                });
                break;
            case 'warning':
                Toast.fire({
                    // icon: 'warning',
                    title: '{{ Session::get('message') }}'
                });
                break;
            case 'success':
                Toast.fire({
                    // icon: 'success',
                    title: '{{ Session::get('message') }}'
                });
                break;
            case 'error':
                Toast.fire({
                    // icon: 'error',
                    title: '{{ Session::get('message') }}'
                });
                break;
        }
    @endif

    @if(isset($errors->all()[0]))
        Toast.fire({
            // icon: 'error',
            title: '{{ $errors->all()[0] }}'
        });
    @endif

</script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{ asset('AdminLTE/dist/js/pages/dashboard2.js') }}"></script>         --}}
{{-- <script src="{{ asset('resources/js/crud.js') }}"></script> --}}
@stack('js');   