@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Detail Data Konsultan'])

<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Detail Data Konsultan</h5>
    </div>
</div>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detail Data Konsultan</h5>
            <p class="card-text">Berikut adalah detail konsultan:</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div for="name">Nama</div>
                        <p>{{ $consultant->name }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div for="gender">Jenis Kelamin</div>
                        <p>{{ $consultant->gender }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div for="birth">Tanggal Lahir</div>
                        <p>{{ $consultant->birth }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div for="telp">No HP (Whatsapp)</div>
                        <p>{{ $consultant->telp }}</p>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div for="jabatan">Jabatan</div>
                        <p>{{ $consultant->jabatan }}</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div for="desc">Deskripsi Diri</div>
                        <p>{{ $consultant->desc }}</p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <div for="photo">Foto</div>
                        @if(isset($consultant->photo) && Storage::disk('public')->exists($consultant->photo))
                            <img src="{{ asset('storage/' . $consultant->photo) }}" alt="Foto Konsultan" class="img-fluid" style="max-width: 400px; height: auto;">
                        @else
                            <p>Tidak ada foto.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
