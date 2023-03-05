@extends('layout.main')

@section('container')
    <div class="page-content">
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="col-6 col-lg-4 col-md-6">
                        <a href="#">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon blue">
                                                <i class="iconly-boldUser"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">User</h6>
                                            <h6 class="font-extrabold mb-0">count user</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <a href="#">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon purple">
                                                <i class="iconly-boldSearch"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Data Latih</h6>
                                            <h6 class="font-extrabold mb-0">count latih</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-6 col-lg-4 col-md-6">
                        <a href="#">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="stats-icon red">
                                                <i class="iconly-boldStar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <h6 class="text-muted font-semibold">Data uji</h6>
                                            <h6 class="font-extrabold mb-0">count_uji</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Diagram Lingkaran Data Hama & Penyakit --}}
        <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <div class="d-block text-center mt-2">
                        <img src="{{asset('img/BG3.png')}}" alt="" width="650" height="340">
                    </div>

                    <!-- buat 2 kolom dibawah
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Diagram Lingkaran Riwayat Data Hama</h4>
                            </div>
                            <div class="card-body px-3 py-0-5">
                                <div class="row">
                                    <canvas id="barHama"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Diagram Lingkaran Riwayat Data Penyakit</h4>
                            </div>
                            <div class="card-body px-3 py-0-5">
                                <div class="row">
                                    <canvas id="barPenyakit"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                    
                </div>
            </div>
        </section>

        {{-- Data Hama --}}
        {{--  <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <h3>Riwayat Data Hama</h3>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Hasil Diagnosa Hama</h4>
                            </div>
                            <div class="card-body px-3 py-0-5">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Hasil Diagnosa</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($hasilhamas as $row)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $row->nama }}</td>
                                                        <td class="text-end">{{ unserialize($row->cf_max)[2] }}
                                                            <b>(<span
                                                                    class="text-danger">{{ number_format(unserialize($row->cf_max)[0] * 100, 2) }}%</span>)</b>
                                                        </td>
                                                        <td>{{ $row->created_at->format('d M Y') }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Hasil Hama Tidak Ditemukan
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Grafik Riwayat Data Hama</h4>
                            </div>
                            <div class="card-body px-3 py-0-5">
                                <div class="row">
                                    <canvas id="barHama"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>  --}}

        {{-- Data Penyakit --}}
        {{--  <section class="row">
            <div class="col-12 col-lg-12">
                <div class="row">
                    <h3>Riwayat Data Penyakit</h3>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Hasil Diagnosa Penyakit</h4>
                            </div>
                            <div class="card-body px-3 py-0-5">
                                <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="tablePenyakit">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Hasil Diagnosa</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @forelse ($hasilpenyakits as $row)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $row->nama }}</td>
                                                        <td class="text-end">{{ unserialize($row->cf_max)[2] }}
                                                            <b>(<span
                                                                    class="text-danger">{{ number_format(unserialize($row->cf_max)[0] * 100, 2) }}%</span>)</b>
                                                        </td>
                                                        <td>{{ $row->created_at->format('d M Y') }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">Hasil Penyakit Tidak
                                                            Ditemukan
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Grafik Riwayat Data Penyakit</h4>
                            </div>
                            <div class="card-body px-3 py-0-5">
                                <div class="row">
                                    <canvas id="barPenyakit"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>  --}}
    </div>

    {{--  Grafik Hama  --}}
    <script src="{{ asset('mazer/vendors/chartjs/Chart.min.js') }}"></script>
    <script>
        var chartColors = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            info: '#41B1F9',
            blue: '#3245D1',
            purple: 'rgb(153, 102, 255)',
            grey: '#EBEFF6'
        };
    </script>   
@endsection
