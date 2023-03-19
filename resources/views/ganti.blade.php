@extends('layout.main')
@section('container')

<div class="container">
    <section class="row">
        <br>

        <div class="mt-5 col-md-7">
            <img src="{{asset('img/ganti.png')}}" alt="" width="500" height="410">
        </div>
        <br>
        <div class="mt-4 col-md-5">
            <br>
            <br>
            <h2>Ganti Password</h2>
            <br>

            <form method="POST" action="{{ route('update-password', $user->id)}}">
                @csrf
                <div class="">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @if($errors->any())
                    @foreach($errors->all() as $err)
                    <div class="alert alert-danger alert-dismissible show fade">
                        {{ $err }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="form-floating" data-aos="fade-up" data-aos-delay="">
                    <input type="text" name='password_lama' class="form-control" id="Pasword" placeholder="Pasword" autocomplete="off" autofocus required>
                    <label for="Password">Password Lama</label>
                    <br>
                </div>
                <div class="form-floating mt-3" data-aos="fade-up" data-aos-delay="800">
                    <input type="password" name='password_baru' autocomplete="off" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Password Baru</label>
                </div>
                <div class="form-floating mt-3" data-aos="fade-up" data-aos-delay="800">
                    <input type="password" name='konfirmasi_password' autocomplete="off" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Konfirmasi Password Baru</label>
                    <br>
                </div>
                <div class="offset-8 col-md-4">
                    <button class="w-100 btn btn-lg btn-primary" type="submit" data-aos="fade-up" data-aos-delay="1200">Ubah</button>
                </div>
            </form>

        </div>
    </section>
</div>


@endsection