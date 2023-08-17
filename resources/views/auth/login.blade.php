@extends('layouts.app')

@section('content')
    <main class="main-content mt-0 bg-gray-200">
        <section>
            
            <div class="page-header min-vh-100 d-flex justify-content-center align-items-center">
                <div class="container">
                    <div class="d-flex justify-content-center align-center">
                        <img src="{{ asset('img/ekliwas.png') }}"  alt="logo" class="w-20 h-20 ">
                    </div>
                    <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center pt-4 ">
                        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto border bg-white mt-10">
                            <div class="card-header pb-0 text-start">
                                <h4 class="font-weight-bolder text-center">Selamat Datang</h4>
                                
                            </div>
                            <div class="card-body ">
                                <form role="form" method="POST" action="{{ route('login.perform') }}">
                                    @csrf
                                    @method('post')
                                    <div class="flex flex-col mb-3">
                                        <input type="email" name="email" class="form-control form-control-lg" value="{{ old('email') ?? 'admin@argon.com' }}" aria-label="Email">
                                        @error('email') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                    <div class="flex flex-col mb-3">
                                        <input type="password" name="password" class="form-control form-control-lg" aria-label="Password" value="secret" >
                                        @error('password') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" name="remember" type="checkbox" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Biarkan Tetap Masuk</label>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                    </div>
                                </form>
                            </div>
                            <p class="form-check-label text-center">Tidak memiliki akun? <a href="/register" class="text-bold">Daftar</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center font-light mt-4">&copy; E-Kliwas Inpektorat Kabupaten Garut 2023.</p>
        </section>
    </main>
@endsection
