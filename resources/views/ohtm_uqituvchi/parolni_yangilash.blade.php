@extends('layouts.uqituvchi')

@section('title', 'OHTM_Uquv_bulimi - Fanlar')

@section('link')

    <link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"
          rel="stylesheet"
          type="text/css"/>

    <!-- DataTables -->
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>

    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}"
          rel="stylesheet"
          type="text/css"/>


    <link href="{{ asset('assets/libs/select2/css/select2.min.css" rel="stylesheet') }}" type="text/css"/>
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css"/>


    <!-- DataTables -->

    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css') }}" rel="stylesheet"
          type="text/css"/>

    <link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css"/>

@endsection

@section('content')
    {{--    @dd($ohtms) --}}


    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0" style="font-size: 25px"> Parolni yangilash</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">E-talim</a></li>
                        <li class="breadcrumb-item active">Parolni yangilash</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-white text-center" style="background: #2d3044">
                        <h4 class="mb-0 text-white">Parolni yangilash</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('uqituvchi.parolni_yangilash.update_password', $userId) }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Eski Parol:</label>
                                <input type="password" name="password" class="form-control"
                                       placeholder="Eski parolingizni kiriting" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Yangi Parol:</label>
                                <input type="password" name="new_password" class="form-control"
                                       placeholder="Yangi parolni kiriting" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Yangi Parolni Tasdiqlang:</label>
                                <input type="password" name="new_password_confirmation" class="form-control"
                                       placeholder="Yangi parolni tasdiqlang" required>
                            </div>

                            <button type="submit" class="btn btn-success w-100">Parolni o‘zgartirish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>






@endsection

@section('script')

    <!-- JAVASCRIPT -->

    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>


    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('assets/js/pages/sweet-alerts.init.js') }}"></script>

    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>
    <script>
        @if (session('success'))
        Swal.fire({
            position: "center",
            icon: "success",
            title: "{{ session()->get('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
        @endif
        @if (session('error'))
        Swal.fire({
            position: "center",
            icon: "error",
            title: "Xatolik!",
            text: "{{ session()->get('error') }}",
            showConfirmButton: false,
            timer: 1500
        });
        @endif

        @foreach ($errors->all() as $error)
        Swal.fire({
            icon: "error",
            title: "Xatolik!",
            text: "{{ $error }}",
            // footer: '<a href="#">Why do I have this issue?</a>'
        });
        @endforeach


    </script>

@endsection
