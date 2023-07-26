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

        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-2">
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
                                <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
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
                                <i class="fa fa-usd text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
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
                                <i class="fa fa-percent text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4 card">
        <div class="col-lg-12 mb-lg-0 mb-4 d-flex justify-content-center py-5 ">
            <a href="{{ route('report.create') }}">
           <div class="d-flex flex-column justify-content-center text-center">
                <i class="fas fa-volume-up" style="font-size: 150px;"></i>
                <h3>Ajukan Laporan</h3>
            </div>
           </a>
        </div>
    </div>

    @include('layouts.footers.auth.footer')
</div>
@endsection
