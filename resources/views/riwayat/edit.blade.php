@extends('layout.app')
@section('container')
<section id="hero" class="mt-4">
    <div class="container">

        <div class="page-content">
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center card-title">Edit Data Klasifikasi</h4>
                    </div>
                    <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_pendaftara">No. Pendaftaran</label >
                                <input type="text" class="form-control mt-2" name="no_pendaftara" id="no_pendaftara" placeholder="No. Pendaftaran">
                            </div>
                            <div class="form-group mt-3">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input type="text" class="form-control mt-2" name="nama_siswa" id="nama_siswa" placeholder="Nama Siswa">
                            </div>
                            <div class="form-group mt-3">
                                <label for="nama_sekolah">Nama Sekolah</label>
                                <input type="text" class="form-control mt-2" name="nama_sekolah" id="nama_sekolah" placeholder="Nama Sekolah">
                            </div>
                        </div>

                        <div class="col-md-7 offset-1">
                            <!-- Nilai IPA -->
                            <div class="form-group row">
                                <label for="nilai_ipa" class="col-sm-2 col-form-label">IPA</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_ipa1">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_ipa2">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_ipa2">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_ipa2">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_ipa2">
                                </div>
                            </div>

                            <!-- Nilai Matematika -->
                            <div class="form-group row mt-3">
                                <label for="nilai_mtk" class="col-sm-2 col-form-label">MTK</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_mtk1">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_mtk2">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_mtk2">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_mtk2">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_mtk2">
                                </div>
                            </div>

                            <!-- Nilai IPS -->
                            <div class="form-group row mt-3">
                                <label for="nilai_ips" class="col-sm-2 col-form-label">IPS</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_ips1">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_ips2">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_ips2">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_ips2">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_ips2">
                                </div>
                            </div>

                            <!-- Minat & Nilai Test -->
                            <div class="form-group row mt-3">
                                <label for="nilai_test" class="col-sm-2 col-form-label">Nilai Test</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="nilai_test">
                                </div>

                                <label for="minat" class="col-sm-2 offset-1 col-form-label">Minat</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="minat" id="minat">
                                        <option value="">--Silahkan Pilih--</option>
                                        <option value="IPA">IPA</option>
                                        <option value="IPS">IPS</option>
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-primary offset-10 mt-4">Simpan</button>
                        </div>

                        
                        
                    </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
@endsection