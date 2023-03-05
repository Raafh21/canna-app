@extends('layout.main')

@section('container')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 text-center">
                <div class="col-md-12">
                    <h1>Data Training</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card table-responsive card-outline card-secondary">
                <div class="row">
                    <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary ml-2 mt-3 mb-3" data-toggle="modal" data-target="#tambahModal">
                            Tambah Data
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Training</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="training/tambah.php" method="post">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="nama_siswa">Nama Siswa</label>
                                                <input type="text" autocomplete="off" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Masukkan Nama Siswa">
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_sekolah">Nama Sekolah</label>
                                                <input type="text" autocomplete="off" class="form-control" id="nama_sekolah" name="nama_sekolah" placeholder="Masukkan Nama Sekolah">
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="minat">Minat</label>
                                                        <input type="text" autocomplete="off" class="form-control" id="minat" name="minat" placeholder="Minat">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="nilai_tes">Nilai Tes</label>
                                                        <input type="text" autocomplete="off" class="form-control" id="nilai_tes" name="nilai_tes" placeholder="Nilai Tes">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label for="hasil">Hasil</label>
                                                        <input type="text" autocomplete="off" class="form-control" id="hasil" name="hasil" placeholder="Hasil">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <table class="table table-bordered table-hover" id="#trainingTable" style="width:100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Asal Sekolah</th>
                                        <th>MTK</th>
                                        <th>IPA</th>
                                        <th>IPS</th>
                                        <th>Minat</th>
                                        <th>Nilai Tes</th>
                                        <th>Hasil</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                              @foreach($training as $row)
                              <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$row->nama_siswa }}</td>
                                <td>{{$row->nama_sekolah}}</td>
                                <td>{{$row->mtk_grade}}</td>
                                <td>{{$row->ipa_grade}}</td>
                                <td>{{$row->ips_grade}}</td>
                                <td>{{$row->minat}}</td>
                                <td>{{$row->nilai_tes}}</td>
                                <td>{{$row->nilai_tes}}</td>
                                <td>
                                            <a class="btn btn-info btn-sm" target="_blank" href="nilai_raport.php?id=<?= $row["id"]; ?>"><i class="bi bi-eye-fill"></i></a>
                                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#EditModal<?= $row["id"]; ?>"><i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm hapus_training" href="training/hapus.php?id=<?= $row["id"]; ?>"><i class="bi bi-trash-fill"></i></a>
                                </td>
                              </tr>
                              @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


@endsection
