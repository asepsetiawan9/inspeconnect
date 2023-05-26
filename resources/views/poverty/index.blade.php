@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Data Kemiskinan'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Data Kemiskinan</h5>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group ">
                    <label for="filter1" class="text-white text-sm pb-2 font-weight-bold">Tampilkan Berdasarkan:</label>
                    <select class="form-select" id="filter1">
                        <option value="semua">Semua Kecamatan</option>
                        <!-- tambahkan opsi kecamatan lainnya di sini -->
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="filter2" class="text-white text-sm pb-2 font-weight-bold">Desil:</label>
                    <select class="form-select" id="filter2">
                        <option value="semua">Semua Desil</option>
                        <option value="desil 1">Desil 1</option>
                        <option value="desil 2">Desil 2</option>
                        <option value="desil 3">Desil 3</option>
                        <option value="desil 4">Desil 4</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="filter3" class="text-white text-sm pb-2 font-weight-bold">Tahun:</label>
                    <select class="form-select" id="filter3">
                        <option value="semua">Semua Tahun</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3 d-flex justify-content-end">
                <a href="{{ route('poverty.create') }}" class="mt-4"> <button
                        class="btn btn-success">Tambah</button></a>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card mb-4">

        <div class="card-header pb-0 d-flex justify-content-between">
            <h6>Data Kemiskinan</h6>
            <div>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari..." onchange="searchData()">
            </div>
        </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NAMA
                                    LENGKAP</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIK
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NO KK
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    KECAMATAN</th>
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
                    <div id="pagination-links">
                        {{ $povertys->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    fetch('/poverty/getKecamatan')
        .then(response => response.json())
        .then(data => {
            const selectElement = document.getElementById('filter1');
            data.data.forEach(kecamatan => {
                const option = document.createElement('option');
                option.value = kecamatan.id;
                option.text = kecamatan.name;
                selectElement.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });

</script>
@endpush

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

function searchData() {
    var searchQuery = $('#searchInput').val();

    $.ajax({
        url: '{{ route("poverty.searchData") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            query: searchQuery
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
                loadPage(page);
            });
        },
        error: function(xhr) {
            // Menangani kesalahan jika ada
        }
    });
}

function loadPage(page) {
    var searchQuery = $('#searchInput').val();

    $.ajax({
        url: '{{ route("poverty.searchData") }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            query: searchQuery,
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
                loadPage(page);
            });
        },
        error: function(xhr) {
            // Menangani kesalahan jika ada
        }
    });
}



    function filterData(page = 1) {
        var filterKecamatan = $('#filter1').val();
        var filterDesil = $('#filter2').val();
        var filterTahun = $('#filter3').val();

        $.ajax({
            url: '{{ route("poverty.filterData") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                kecamatan: filterKecamatan,
                desil: filterDesil,
                tahun: filterTahun,
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
        $('#filter1, #filter2, #filter3').change(function() {
            filterData();
        });
    });
</script>
@endpush
