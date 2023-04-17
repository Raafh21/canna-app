<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta  name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistem penjurusan Siswa - Canna</title>
    <meta content="" name="description">

    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/logo3.png') }}" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('flex-start/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('flex-start/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('flex-start/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('flex-start/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('flex-start/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('flex-start/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('mazer/vendors/simple-datatables/style.css') }}">

    <!-- Template Main CSS File -->
    <link href="{{ asset('flex-start/css/style.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('plugin/datatables-bs4/css/dataTables.bootstrap.min.css')}}" /> -->


    <!-- =======================================================
  * Template Name: FlexStart - v1.12.0
  * Template URL: https://bootstrapmade.com/flexstart-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="/" class="logo d-flex align-items-center">
                <img src="{{ asset('img/logo1.png') }}" alt="">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="navbar-nav " href="{{route ('riwayat.create') }}">Klasifikasi</a></li>
                    <li><a class="navbar-nav " href="{{route ('riwayat.index') }}">Riwayat Klasifikasi</a></li>
                    <li><a class="navbar-nav " href="{{route ('about') }}">Tentang</a></li>
                                        <li><a class="getstarted " href="/login">Masuk</a></li>
                                    </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

@yield('container')

    <!-- Vendor JS Files -->
    <script src="{{ asset('flex-start/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('flex-start/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('flex-start/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('flex-start/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('flex-start/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('flex-start/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('mazer/vendors/jquery/jquery.min.js') }}"></script>

    <!-- Template Main JS File -->
     <script src="{{ asset('flex-start/js/main.js') }}"></script>

    <!-- DataTables  & Plugins -->
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


</body>

</html>