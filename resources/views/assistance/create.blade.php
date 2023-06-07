@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Tambah Data Bantuan'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Tambah Data Bantuan</h5>
        <div class="card px-5 py-3">
        <form action="{{ route('assistance.store') }}" method="POST" enctype="multipart/form-data">
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

        <div class="d-flex justify-content-between pt-3">
            <div></div>
            <div id="tambahBantuanBtn" class="btn btn-primary">Tambah bantuan</div>
        </div>

        <div id="formContainer">
            <!-- Form bantuan awal (tidak ditampilkan) -->
            <div style="display: none;">
                <div class="formBantuan d-flex">
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_bantuan">Nama Bantuan</label>
                                <input type="text" name="nama_bantuan[0]" class="form-control" placeholder="Nama Bantuan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pemberi_bantuan">Pemberi Bantuan</label>
                                <input type="text" name="pemberi_bantuan[0]" class="form-control" placeholder="Pemberi Bantuan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea type="text" name="keterangan[0]" class="form-control" placeholder="Keterangan"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="bukti">Bukti Bantuan</label>
                            <div class="input-group">
                                <input type="file" name="bukti[0]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center ">
                        <div class="btn btn-danger btn-sm removeFormBtn" type="button">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </div>
                    </div>
                    <hr>
                </div>
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
    $(document).ready(function () {
        // Mendapatkan elemen select pertama
        var filter1 = $('#filter1');
        // Mendapatkan elemen select kedua
        var filter2 = $('#filter2');

        // Memantau perubahan pada filter1
        filter1.on('change', function () {
            var selectedYear = $(this).val();

            if (selectedYear !== '') {
                // Mengirim permintaan AJAX ke backend
                $.ajax({
                    url: '/get-poverty-data',
                    type: 'GET',
                    data: {
                        year: selectedYear
                    },
                    success: function (response) {
                        console.log(response);
                        // Menghapus opsi sebelumnya pada filter2
                        filter2.empty();
                        // Menambahkan opsi baru berdasarkan data yang diterima dari backend
                        $.each(response, function (key, value) {
                            var optionText = value.nama + ' -' + ' (' + value.nik +
                                ')';
                            filter2.append($('<option></option>').attr('value',
                                value.id).text(optionText));
                        });
                        // Mengaktifkan filter2
                        filter2.prop('disabled', false);
                    },
                    error: function () {
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
    $(document).ready(function () {
        // Inisialisasi elemen select2
        $('.selectName').select2();
    });

</script>

<script>
    $(document).ready(function () {
        // Menambahkan event click pada tombol "Tambah bantuan"
        $("#tambahBantuanBtn").click(function () {
            // Menampilkan form bantuan
            $("#formBantuan").show();
        });
    });

</script>
<script>
    $(document).ready(function () {
        var formCount = 0; // Jumlah form bantuan awal

        // Menyembunyikan form bantuan awal
        $(".formBantuan").hide();

        // Menambahkan event click pada tombol "Tambah bantuan"
        $("#tambahBantuanBtn").click(function () {
            var newForm = $(".formBantuan").first().clone(); // Menduplikat form bantuan awal
            newForm.find("input, textarea").val(""); // Mengosongkan nilai input pada form baru

            // Memberikan atribut name yang unik untuk setiap elemen input dalam form baru
            newForm.find("input[name^='nama_bantuan']").each(function (index) {
                var fieldName = $(this).attr("name");
                fieldName = fieldName.replace(/\[\d+\]/, "[" + (formCount + index) + "]");
                $(this).attr("name", fieldName);
            });

            newForm.find("input[name^='pemberi_bantuan']").each(function (index) {
                var fieldName = $(this).attr("name");
                fieldName = fieldName.replace(/\[\d+\]/, "[" + (formCount + index) + "]");
                $(this).attr("name", fieldName);
            });

            newForm.find("textarea[name^='keterangan']").each(function (index) {
                var fieldName = $(this).attr("name");
                fieldName = fieldName.replace(/\[\d+\]/, "[" + (formCount + index) + "]");
                $(this).attr("name", fieldName);
            });

            newForm.find("input[name^='bukti']").each(function (index) {
                var fieldName = $(this).attr("name");
                fieldName = fieldName.replace(/\[\d+\]/, "[" + (formCount + index) + "]");
                $(this).attr("name", fieldName);
            });

            // Menambahkan event click pada tombol "Hapus form"
            newForm.find(".removeFormBtn").click(function () {
                $(this).closest(".formBantuan").remove(); // Menghapus form
            });

            newForm.appendTo("#formContainer"); // Menambahkan form baru ke dalam container
            formCount++; // Menambah jumlah form
            newForm.show(); // Menampilkan form baru
        });
    });
</script>


@endpush
