@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard Warga'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="container position-relative ">
            <div class="row">
                <div class="pb-3 text-bold text-white">Dashboard Warga Inspeconnect</div>
            </div>
        </div>  

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-2">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-xs mb-0 text-uppercase font-weight-bold">JUMLAH LAPORAN TERKIRIM</p>
                            <h5 class="font-weight-bolder" id="jumlah_rumah">
                                {{ $data['laporanterkirim'] }}
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
                                <p class="text-xs mb-0 text-uppercase font-weight-bold">Jumlah Laporan Terselesaikan</p>
                                <h5 class="font-weight-bolder" id="jml_tidak_layak">
                                    {{ $data['ditanggapi'] }}
                                    
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
                                    {{ $data['laporandiproses'] }}
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
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-xs mb-0 text-uppercase font-weight-bold">Konsultasi Belum Ditanggapi </p>
                                <h5 class="font-weight-bolder" id="jml_layak">
                                    {{ $data['konsultasibaru'] }}
                                </h5>
                                <p class="mb-0">
                                    Laporan
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="fa fa-commenting text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" mt-3">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <h5 class="p-3">Jadwal Konsultasi</h5>
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">

                        <ul class="list-group list-group-flush">
                            @forelse($data['konsultasidiperoses'] as $konsul)
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
                                                <div class="pt-3">{{ $konsul->skpd->name ? $konsul->skpd->name : '-' }}</div>
                                            </div>
                                            <div>
                                                <span>{{ $konsul->consultant->name ? $konsul->consultant->name : '-' }}</span> <br>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </a>
                            @empty
                                <li class="list-group-item">
                                    <p class="text-center">Jadwal konsultasi yang akan dihadiri tidak ada.</p>
                                </li>
                            @endforelse
                        </ul>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-8">
                <div class="card">
                    <div class="card-body d-flex flex-row gap-4 justify-content-center align-items-center py-5">
                        
                            <a href="{{ route('schedule.create') }}" class="text-decoration-none m-4 rounded">
                                <i class="fa fa-handshake-o" style="font-size: 150px;"></i>
                                <h3 class="mt-3 text-center">Konsultasi</h3>
                            </a>
                    
                            <a href="{{ route('report.create') }}" class="text-decoration-none m-4 rounded">
                                <i class="fas fa-volume-up" style="font-size: 150px;"></i>
                                <h3 class="mt-3 text-center">Ajukan Laporan</h3>
                            </a>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    @include('layouts.footers.auth.footer')
</div>
@endsection
