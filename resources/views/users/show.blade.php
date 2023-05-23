@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => ' Pengguna'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white"> Pengguna</h5>
    </div>
</div>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Detail Pengguna</h5>
            <p class="card-text">Berikut adalah detail pengguna:</p>
            <div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div for="name">NAMA PENGGUNA</div>
                        <strong>{{ $user->username }}</strong>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div for="email">Email</div>
                        <strong>{{ $user->email }}</strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div for="email">No Telpon</div>
                        <strong>{{ $user->phone }}</strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div for="email">Role</div>
                        <strong>{{ $user->role === 'kec' ? 'Admin Kecamatan' : '' }}</strong>
                        <strong>{{ $user->role === 'des' ? 'Admin Desa' : '' }}</strong>
                        <strong>{{ $user->role === 'admin' ? 'Administrator' : '' }}</strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div for="email">Kecamatan</div>
                        <strong>{{ $user->city }}</strong>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div for="email">Desa</div>
                        <strong>{{ $user->desa }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
