@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => ' Detail Data Warga'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white"> Detail Data Warga</h5>
    </div>
</div>
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detail Data Warga</h5>
            <p class="card-text">Berikut adalah detail pengguna:</p>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div for="name">Nama</div>
                        <strong>{{ $user->name }}</strong>
                    </div>
                </div>
                
               
                <div class="col-md-4">
                    <div class="form-group">
                        <div for="status">Status</div>
                        <strong>{{ $user->status === 0 ? 'Belum Di Verifikasi' : 'Terverifikasi' }}</strong>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div for="address">Alamat</div>
                        <strong>{{ $user->address }}</strong>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection
