@extends('layout.main')
@section('container')

<div class="page-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">{{ $title }}</h2>
            </div>
            <div class="card-body">
                <a href="" class="btn btn-danger btn-sm mb-3">
                    Hapus Pohon Keputusan</a>
                <a href="/uji" class="btn btn-secondary btn-sm mb-3">
                    Uji Rule</a>

                <p>Jumlah Rule = </p>
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Rule/Aturan</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </section>
</div>

@endsection