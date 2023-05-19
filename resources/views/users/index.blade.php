@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Data Pengguna'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Data Pengguna</h5>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="filter1" class="text-white text-sm pb-2 font-weight-bold">Tampilkan Berdasarkan:</label>
                    <select class="form-select" id="filter1" onchange="filterData(this.value)">
                        <option selected value="semua">Semua Data</option>
                        <option value="kecamatan">Semua Kecamatan</option>
                        <option value="desa">Semua Desa</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="filter2" class="text-white text-sm pb-2 font-weight-bold">Jenis Pengguna:</label>
                    <select class="form-select" id="filter2" onchange="filterData(this.value)">
                        <option selected>Semua</option>
                        <option value="kecamatan">Admin Kecamatan</option>
                        <option value="desa">Admin Desa</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <div class="mt-4"> <button class="btn btn-success">Tambah Pengguna</button></div>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA
                                    PENGGUNA</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    EMAIL</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    NO. HP</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    KECAMATAN</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    DESA</th>
                                <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">
                                    AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="users-table">
                            @include('users.partial_table')
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

<!-- @push('js')
<script>
    const iconBar = document.querySelector('.icon-bar');
    const actionButtons = document.querySelectorAll('.action-buttons div');

    iconBar.addEventListener('click', function () {
        actionButtons.forEach((button, index) => {
            setTimeout(function () {
                button.classList.toggle('d-none');
            }, 100 * (index + 1));
        });
    });

</script>

@endpush -->
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function filterData(filterValue) {
        // Mengirim permintaan AJAX ke server untuk memperbarui tabel dengan data yang difilter
        // Misalnya, menggunakan jQuery $.ajax():
        $.ajax({

            url: '{{ route("user-management.filter") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Pastikan token CSRF ditambahkan
                filter: filterValue
            },
            // data: { filter: filterValue },
            success: function(response) {
                // Mengganti isi tabel dengan data yang baru
                $('#users-table').html(response);
            },
            error: function(xhr) {
                // Menangani kesalahan jika ada
            }
        });
    }
</script>
@endpush