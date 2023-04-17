@extends('layout.app')
@section('container')
<section id="hero">
    <div class="container">

        <div class="page-content">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$title}}</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Nama Sekolah</th>
                                    <th>Nilai Tes</th>
                                    <th>Minat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($training as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama_siswa }}</td>
                                    <td>{{ $row->nama_sekolah }}</td>
                                    <td>{{ $row->nilai_tes }}</td>
                                    <td>{{ $row->minat }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>

    </div>
</section>
@endsection