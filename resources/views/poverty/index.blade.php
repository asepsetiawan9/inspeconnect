@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Data Kemiskinan'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Data Kemiskinan</h5>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <a href="{{ route('poverty.create') }}" class="mt-4"> <button class="btn btn-success">Tambah</button></a>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Kemiskinan</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA LENGKAP</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIK</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO KK</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">KECAMATAN</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DESA
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DESIL
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TAHUN
                                </th>
                                <th
                                    class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="users-table">
                            @if ($povertys->isEmpty())
                            <tr>
                                <td class="text-center" colspan="8">Data tidak ada.</td>
                            </tr>
                            @else
                                @include('poverty.partial_table')
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $povertys->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
