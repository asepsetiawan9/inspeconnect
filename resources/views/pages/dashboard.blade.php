@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="container position-relative ">
            <div class="row">
                <div class="pb-3 text-bold text-white">Dashboard Inspeconnect</div>
            </div>
        </div>  

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-xs mb-0 text-uppercase font-weight-bold">JUMLAH LAPORAN BARU</p>
                            <h5 class="font-weight-bolder" id="jumlah_rumah">
                                {{ $data['laporanbaru'] }}
                            </h5>
                            <p class="mb-0">
                                Laporan
                            </p>
                        </div>
                    </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="fa fa-paper-plane text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-xs mb-0 text-uppercase font-weight-bold">JUMLAH KONSULTASI BARU</p>
                                <h5 class="font-weight-bolder" id="jml_kk">
                                    {{ $data['konsultasibaru'] }}
                                   
                                </h5>
                                <p class="mb-0">
                                    Permintaan
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="fa fa-user text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-xs mb-0 text-uppercase font-weight-bold">Jumlah Laporan Terselesaikan</p>
                                <h5 class="font-weight-bolder" id="jml_tidak_layak">
                                    {{ $data['laporanselesai'] }}
                                    
                                </h5>
                                <p class="mb-0">
                                    Laporan
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="fa fa-check-circle text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-xs mb-0 text-uppercase font-weight-bold">Laporan Sedang Diproses </p>
                                <h5 class="font-weight-bolder" id="jml_layak">
                                    {{ $data['laporanproses'] }}
                                </h5>
                                <p class="mb-0">
                                    Laporan
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fa fa-spinner text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-7 mb-lg-0 mb-4">
            <div class="card p-3">
                <h5>Permintaan Konsultasi</h5>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list-group list-group-flush">
                        @foreach($data['permintaankonsul'] as $konsul)
                        <a href="{{ url('schedule/show/'.$konsul->id) }}" title="{{ $konsul->name ? $konsul->name : '-' }}">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{ asset('storage/' . $konsul->consultant->photo) }}" alt="Consultant Photo" class="img-fluid rounded">
                                    </div>
                                    <div class="col-md-9 d-flex flex-column justify-content-between">
                                        <div>
                                            <label class="fs-6">{{ $konsul->created_at }}</label><br />
                                            Jam {{ $konsul->time ? $konsul->time : '-' }} - {{ $konsul->date ? $konsul->date : '-' }}
                                            <div class="pt-3">{{ $konsul->skpd->name ? $konsul->skpd->name : '-' }}</div class="pt-3">
                                        </div>
                                        <div>
                                            <span>{{ $konsul->consultant->name ? $konsul->consultant->name : '-' }}</span> <br>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            </a>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-5">
            <div class="card p-3">
                <h5>Laporan Baru</h5>
                <div class="row">
                <ul class="list-group list-group-flush">
                        @foreach($data['laporanbarulist'] as $laporan)
                        <a href="{{ url('report/show/'.$laporan->id) }}" title="{{ $laporan->name ? $laporan->name : '-' }}">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <label class="fs-6">{{ $laporan->created_at }}</label><br />
                                           Pelapor {{ $laporan->user->name ? $laporan->user->name : '-' }} 
                                        <div> Terlapor {{ $laporan->name ? $laporan->name : '-' }}</div>
                                    </div>
                                </div>
                            </li>
                            </a>
                        @endforeach
                        </ul>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
</div>
@endsection
