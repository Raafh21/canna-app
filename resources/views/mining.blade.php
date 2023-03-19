@extends('layout.main')

@section('container')
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">{{ $title }}</h2>
            </div>
            <div class="card-body">
                <a href="{{ route('perhitungan') }}" class="btn btn-success btn-sm mb-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>Proses Mining</a>

                <p>Jumlah Data Latih = {{ $jumlahData }}</p>
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Siswa</th>
                            <th>Nilai IPA</th>
                            <th>Nilai Matematika</th>
                            <th>Nilai IPS</th>
                            <th>Nilai Tes</th>
                            <th>Minat</th>
                        </tr>
                    </thead>
                    @foreach($dataLatih as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->nama_siswa }}</td>
                        <td>{{ $row->ipa_grade }}</td>
                        <td>{{ $row->mtk_grade }}</td>
                        <td>{{ $row->ips_grade }}</td>
                        <td>{{ $row->nilai_tes }}</td>
                        <td>{{ $row->minat }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </section>
</div>
@endsection