@extends('layout.main')

@section('container')
<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">{{ $title }}</h2>
            </div>
            <div class="card-body">
                <p>Jumlah Data = {{ $jumlahData }}</p>
                <p>Jumlah IPA = {{ $jumlahIPA }}</p>
                <p>Jumlah IPS = {{ $jumlahIPS }}</p>
                <p>All Entropy = {{ $entropyAll }}</p>

                <table class="table table-bordered text-nowrap text-center mt-5">
                    <thead>
                        <tr>
                            <th>Nilai Atribut</th>
                            <th>Jumlah Data</th>
                            <th>Jumlah IPA</th>
                            <th>Jumlah IPS</th>
                            <th>Entropy</th>
                            <th>Gain</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </section>
</div>
@endsection