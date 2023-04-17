@extends('layout.main')

@section('container')
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">{{ $title }}</h2>
            </div>
            <div class="card-body">
                <p>Jumlah Data Uji = </p>
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
                            <th>Hasil (asli)</th>
                            <th>Hasil (sistem)</th>
                            <th>rules</th>
                        </tr>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection