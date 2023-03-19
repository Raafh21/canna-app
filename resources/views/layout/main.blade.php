<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - CANNA</title>

    <!-- Favicons -->
    <link href="{{ asset('img/logo3.png') }}" rel="icon">
    <link href="{{ asset('flex-start/img/logo.png') }}" rel="apple-touch-icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('mazer/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/chartjs/Chart.min.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/vendors/sweetalert2/sweetalert2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/simple-datatables/style.css') }}">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('mazer/images/favicon.svg') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('plugin/datatables-bs4/css/dataTables.bootstrap.min.css')}}" />

</head>

<body>
    <div id="app">
        @include('layout.sidebar')
        <div id="main" class="layout-navbar">
            <header class="mb-3">
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">Safari</h6>
                                            <p class="mb-0 text-sm text-gray-600">Administrator</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar bg-primary">
                                                <span class="avatar-content"></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content" style="padding-top: 0px;">
                @yield('container')
                {{-- <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                    href="http://ahmadsaugi.com">A. Saugi</a></p>
                        </div>
                    </div>
                </footer> --}}
            </div>
        </div>
    </div>

    <script src="{{ asset('mazer/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('mazer/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('mazer/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="{{ asset('mazer/vendors/ckeditor/ckeditor.js') }}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>

    {{-- <script src="{{ asset('mazer/vendors/apexcharts/apexcharts.js')}}"></script>
    <script src="{{ asset('mazer/js/pages/dashboard.js')}}"></script> --}}

    <script src="{{ asset('mazer/js/main.js') }}"></script>
    <script src="{{ asset('mazer/vendors/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('mazer/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugin/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('plugin/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            // DataTable
            $('#trainingTable').DataTable();
        });
    </script>

    <script>
        // Hapus Data Training
        $(document).on('click', '.hapus-training', function(e) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data Training!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus Data!'
            }).then((result) => {
                if (result) {
                    form.submit();
                }
            })
        });
    </script>
</body>

</html>