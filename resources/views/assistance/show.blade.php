@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => ' Detail Data Bantuan'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white"> Detail Data Bantuan</h5>
    </div>
</div>

<div class="container mt-4">
    <div class="card border">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <strong for="name">NIK</strong>
                        <p>{{$assistance->poverty->nik}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong for="name">Nama Penerima Bantuan</strong>
                        <p>{{$assistance->poverty->nama}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <strong for="name">Tahun Bantuan</strong>
                        <p>{{ $assistance->tahun ?: '' }}</p>
                    </div>
                </div>
                <div class="bg-primary p-1 rounded mb-2"> </div>
                @foreach ($assistance->assistDetails as $detail)
                <div class="col-md-6">
                    <div class="form-group">
                        <strong for="name">Nama Bantuan</strong>
                        <p>{{ $detail->nama_bantuan ?: '' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong for="name">Pemberi bantuan</strong>
                        <p>{{ $detail->pemberi_bantuan ?: '' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <strong for="alamat">Keterangan</strong>
                        <p>{{ $detail->keterangan ?: '' }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group d-flex flex-column thumbnail">
                        <strong for="name">Bukti Bantuan</strong>
                        @if ($detail->bukti)
                        <img src="{{ asset('storage/bukti/' . $detail->bukti) }}" alt="Foto Bukti"
                            style="max-width: 50%; height: auto;">
                        @else
                        <p>Tidak ada foto bantuan</p>
                        @endif
                    </div>
                </div>
                <hr>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection
