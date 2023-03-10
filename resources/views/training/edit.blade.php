@extends('layout.main')

@section('container')
<div class="page-content">
    <section class="section col-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="card-body">
                <form class="form form-vertical " method="post" action="{{ route('training.update', $training->id) }}">
                    @method('patch')
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mt-3">
                                    <label for="nama_siswa">Nama Siswa</label>
                                    <input type="text" class="form-control mt-2  @error('nama_siswa') is-invalid @enderror" name="nama_siswa" id="nama_siswa" value="{{ old('nama_siswa', $training->nama_siswa) }}" placeholder="Nama Siswa">
                                    @error('nama_siswa')
                                    <div class="invalid-feedback">
                                        <i class="bx bx-radio-circle"></i>
                                        {{ $message }}.
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="nama_sekolah">Nama Sekolah</label>
                                    <input type="text" class="form-control mt-2" name="nama_sekolah" id="nama_sekolah" value="{{ old('nama_sekolah', $training->nama_sekolah) }}" placeholder="Nama Sekolah">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="minat">Minat</label>
                                    <select class="form-control" name="minat" id="minat">
                                        <option value="">--Silahkan Pilih--</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-7 offset-1">
                                <!-- Nilai IPA -->
                                <div class="form-group row">
                                    <label for="nilai_ipa" class="col-md-2 col-form-label">IPA</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_ipa1" id="nilai_ipa1">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_ipa2" id="nilai_ipa2">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_ipa3" id="nilai_ipa3">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_ipa4" id="nilai_ipa4">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_ipa5" id="nilai_ipa5">
                                    </div>
                                </div>

                                <!-- Nilai Matematika -->
                                <div class="form-group row">
                                    <label for="nilai_mtk" class="col-md-2 col-form-label">Matematika</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_mtk1" id="nilai_mtk1">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_mtk2" id="nilai_mtk2">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_mtk3" id="nilai_mtk3">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_mtk4" id="nilai_mtk4">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_mtk5" id="nilai_mtk5">
                                    </div>
                                </div>

                                <!-- Nilai IPS -->
                                <div class="form-group row">
                                    <label for="nilai_ips" class="col-md-2 col-form-label">IPS</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_ips1" id="nilai_ips1">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_ips2" id="nilai_ips2">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_ips3" id="nilai_ips3">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_ips4" id="nilai_ips4">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" name="nilai_ips5" id="nilai_ips5">
                                    </div>
                                </div>



                                <!-- Minat & Nilai Test -->
                                <div class="form-group row mt-3">
                                    <label for="nilai_tes" class="col-md-2 col-form-label">Nilai Test</label>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" value="{{ old('minat', $training->minat) }}" name="nilai_tes" id="nilai_tes">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary offset-10 mt-4">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>
@endsection