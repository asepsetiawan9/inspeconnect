@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Tambah Data Bantuan'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Tambah Data Bantuan</h5>
        <div class="card px-5 py-3">
            <form action="{{ route('assistance.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <select class="form-select" id="filter1" name="tahun">
                                <option selected value="">Pilih Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            @error('tahun') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_poverty">Nama Penerima</label>
                            <select class="form-select selectName" id="filter2" name="id_poverty">
                                <option selected value="">Pilih Penerima Bantuan</option>
                            </select>
                            @error('id_poverty') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>

                    <div class="col-md-12 rounded bg-primary p-1">
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="karangpawitan">Jumlah karangpawitan</label>
                            <input type="number" name="karangpawitan" class="form-control"
                                placeholder="Jumlah karangpawitan">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Mendapatkan elemen select pertama
        var filter1 = $('#filter1');
        // Mendapatkan elemen select kedua
        var filter2 = $('#filter2');

        // Memantau perubahan pada filter1
        filter1.on('change', function() {
            var selectedYear = $(this).val();

            if (selectedYear !== '') {
                // Mengirim permintaan AJAX ke backend
                $.ajax({
                    url: '/get-poverty-data',
                    type: 'GET',
                    data: { year: selectedYear },
                    success: function(response) {
                        console.log(response);
                        // Menghapus opsi sebelumnya pada filter2
                        filter2.empty();
                        // Menambahkan opsi baru berdasarkan data yang diterima dari backend
                        $.each(response, function(key, value) {
                            var optionText = value.nama + ' -' + ' (' + value.nik + ')';
                            filter2.append($('<option></option>').attr('value', value.id).text(optionText));
                        });
                        // Mengaktifkan filter2
                        filter2.prop('disabled', false);
                    },
                    error: function() {
                        console.log('Gagal mengambil data kemiskinan.');
                    }
                });
            } else {
                // Jika tidak ada tahun yang dipilih, menonaktifkan dan mengosongkan filter2
                filter2.empty().prop('disabled', true);
            }
        });
    });
</script>

@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi elemen select2
        $('.selectName').select2();
    });

</script>
@endpush
