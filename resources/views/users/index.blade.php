@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Data Pengguna'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Data Pengguna</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="filter2" class="text-white text-sm pb-2 font-weight-bold">Jenis Pengguna:</label>
                    <select class="form-select" id="filter2">
                        <option selected value="semua">Semua</option>
                        <option value="skpd">Admin SKPD</option>
                        <option value="warga">Warga</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="filter1" class="text-white text-sm pb-2 font-weight-bold">Status Akun:</label>
                    <select class="form-select" id="filter1">
                        <option selected value="semua">Semua</option>
                        <option value="0">Belum Di Verifikasi</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2 d-flex justify-content-end">
                <a href="{{ route('user-management.create') }}" class="mt-4"> <button class="btn btn-success">Tambah Warga</button></a>
            </div>
            <div class="col-md-2 d-flex justify-content-end">
                <a href="{{ route('user-management.createskpd') }}" class="mt-4"> <button class="btn btn-info">Tambah SKPD</button></a>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Data Pengguna</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">EMAIL</th>
                                
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ROLE</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUS</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="users-table">
                            @if ($users->isEmpty())
                            <tr>
                                <td class="text-center" colspan="8">Data tidak ada.</td>
                            </tr>
                            @else
                                @include('users.partial_table')
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <div id="pagination-links">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function filterData(page = 1) {
        var filterStatus = $('#filter1').val();
        var filterRole = $('#filter2').val();

        $.ajax({
            url: '{{ route("user-management.filterData") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: filterStatus,
                role: filterRole,
                page: page
            },

            success: function(response) {
                // Mengganti isi tabel dengan data yang baru
                $('#users-table').html(response.table);

                // Memperbarui link pagination dengan link baru
                $('.pagination').html(response.pagination);

                // Menambahkan event click pada link pagination
                $('.pagination .page-link').click(function(e) {
                    e.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    filterData(page);
                });
            },
            error: function(xhr) {
                // Menangani kesalahan jika ada
            }
        });
    }

    // Memanggil fungsi filterData saat halaman dimuat
    $(document).ready(function() {
        // Menangkap event change pada dropdown filter
        $('#filter1, #filter2').change(function() {
            filterData();
        });
    });
</script>
@endpush
