@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Data Bantuan'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Data Bantuan</h5>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <a href="{{ route('assistance.create') }}" class="mt-4"> <button class="btn btn-success">Tambah
                        Data Bantuan</button></a>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0 d-flex justify-content-between">
                <h6>Data Kemiskinan</h6>
                <div class="d-flex gap-2">
                    <div class="w-40">
                        <div class="form-group">
                            <select class="form-select" id="filter1" onchange="filterData()">
                                <option value="all">Tahun</option>
                                @foreach ($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

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
                                    NAMA PENERIMA </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    NIK</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    TAHUN</th>
                                <th
                                    class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="users-table">
                            @if ($assistances->isEmpty())
                            <tr>
                                <td class="text-center" colspan="6">Data tidak ada.</td>
                            </tr>
                            @else
                            @include('assistance.partial_table')
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $assistances->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    function filterData() {
        var selectedYear = document.getElementById('filter1').value;
        var searchInput = document.getElementById('searchInput').value;

        var url = "{{ route('assistance.index') }}";
        url += "?year=" + selectedYear;
        url += "&search=" + searchInput;

        window.location.href = url;
    }

</script>
@endpush
