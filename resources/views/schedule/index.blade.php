@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Data Konsultasi'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Data Konsultasi</h5>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <a href="{{ route('schedule.create') }}" class="mt-4"> <button class="btn btn-success">Tambah
                        Data Konsultasi</button></a>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h6>Data Konsultasi</h6>
                <div class="d-flex gap-2">
                    <div>
                        <input type="text" id="searchInput" class="form-control" placeholder="Cari..."
                            onchange="filterData()">
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    SKPD </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    NAMA KONSULTAN</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    TANGGAL KONSULTASI</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    WAKTU KONSULTASI</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    TEMPAT</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    STATUS</th>
                                <th
                                    class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="users-table">
                            @if ($schedules->isEmpty())
                            <tr>
                                <td class="text-center" colspan="6">Data tidak ada.</td>
                            </tr>
                            @else
                            @include('schedule.partial_table')
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $schedules->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

