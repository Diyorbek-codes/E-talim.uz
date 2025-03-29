
@extends('layouts.ohtm_uquv_bulimi')

@section('title', "ohtm_uquv_bulimi")

@section('link')

    <link href="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}"
          rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/select2/css/select2.min.css" rel="stylesheet')}}" type="text/css"/>
    <link href="{{asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- DataTables -->
    <link href="{{asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0; /* Bootstrap animatsiyasini oldini oladi */
        }
        .dropdown-menu {
            max-height: none; /* Yetarlicha balandlik */
            overflow: visible;  /* Scroll chiqishi */
        }
       /* Progress barning to'liq bo'lmagan qismini ajratish */
.progress {
    background-color: #f0f0f0; /* Progress barning to'liq bo'lmagan qismi uchun fon rangi */
}

.progress-bar {
    background: #589dec; /* Progress barning to'liq bo'lgan qismining rangi */
}

/* To'liq bo'lmagan qism uchun rang */
.progress {
    background-color: #cac8c8c5; /* Yengil kulrang yoki boshqa rang */
}

    </style>

@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">O`qituvchining yuklamalari</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Fanlar</a></li>
                        <li class="breadcrumb-item active">Jurnallar</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-- start page title -->


    <div class="row">
        @foreach($fan_uqituvchis as $fan)
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                             <h4 class="fas fa-book text-primary"><strong> {{$fan->getJurnal->fanlar->nomi}}</strong></h4>
                        </div>

                        <p class="mb-3"><strong> {{$fan->getJurnal->guruh->nomi}} </strong></p>
                        <p class="mb-2">Yuklama: <strong> {{$fan->soat}} soat</strong></p>
                        <p class="mb-2">Bajarildi: <strong>{{$fan->getYuklama }} soat</strong></p>
                        <div class="progress mb-4" style="height: 25px">
                            <div class="progress-bar bg-primary font-size-16"  role="progressbar" style="width:{{$fan->getYuklama }}% ;"
                                 aria-valuenow={{$fan->getYuklama }} aria-valuemin="0" aria-valuemax="100">{{$fan->getYuklama }}%
                            </div>
                        </div>
                        {{-- <div class="progress mb-4" style="height: 25px;">
                            <div class="progress-bar" role="progressbar" style="width: {{$fan->getYuklama }}%; height: 100%;"
                                 aria-valuenow="{{ $fan->getYuklama }}" aria-valuemin="0" aria-valuemax="100">{{ $fan->getYuklama  }} %
                            </div> --}}


                    </div>
                </div>
            </div>
            @endforeach
    </div>


    </section>

@endsection

@section('script')

    <!-- JAVASCRIPT -->

    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{ asset('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

    <script src="{{ asset('assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js')}}"></script>


    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('assets/js/pages/sweet-alerts.init.js')}}"></script>

    <script src="{{ asset('assets/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js')}}"></script>
    <script>
        @if(session('success'))
        Swal.fire({
            position: "center",
            icon: "success",
            title: "{{ session()->get('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
        @endif
        @if(session('error'))

        Swal.fire({
            position: "center",
            icon: "error",
            title: "Xatolik!",
            text: "{{ session()->get('error') }}",
            showConfirmButton: false,
            timer: 1500
        });
        @endif

        @foreach($errors->all() as $error)
        Swal.fire({
            icon: "error",
            title: "Xatolik!",
            text: "{{$error}}",
            // footer: '<a href="#">Why do I have this issue?</a>'
        });
        @endforeach
    </script>
@endsection
