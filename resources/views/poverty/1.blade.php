<div class="col-md-6">
    <div class="form-group">
        <label for="nik">NIK</label>
        <input type="text" id="nik" name="nik" class="form-control" placeholder="Masukan NIK"
            value="{{ $poverty->nik ?? '' }}">
        @error('nik') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="kk">NO KK</label>
        <input type="text" id="kk" name="kk" class="form-control" placeholder="Masukan No KK"
            value="{{ $poverty->kk ?? '' }}">
        @error('kk') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="nama">NAMA LENGKAP</label>
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama Lengkap"
            value="{{ $poverty->nama ?? '' }}">
        @error('nama') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
    </div>
</div>

<div class="col-md-6 form-group">
    <label for="jk">JENIS KELAMIN</label>
    <select name="jk" class="form-select" id="jk">
        <option value="">Pilih Jenis</option>
        <option value="laki" @if(isset($poverty) && $poverty->jk === 'laki') selected @endif>Laki-Laki</option>
        <option value="perempuan" @if(isset($poverty) && $poverty->jk === 'perempuan') selected @endif>Perempuan
        </option>
    </select>
    @error('jk') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
</div>


<div class="row">
    <div class="col-md-8 ">
        <div class="form-group">
            <label for="alamat">ALAMAT </label>
            <textarea id="alamat" name="alamat" class="form-control" rows="5" placeholder="Masukkan Alamat Lengkap"
                >{{ $poverty->alamat ?? '' }}</textarea>
            @error('alamat') <p class="text-danger text-xs pt-1">{{ $message }}</p> @enderror
        </div>
    </div>
    <div class="col-md-4 d-flex flex-column">
        <div class="form-group">
            <label for="rt">RT</label>
            <input type="text" id="rt" name="rt" class="form-control" placeholder="Masukkan RT"
                value="{{ $poverty->rt ?? '' }}">
            @error('rt') <p class="text-danger text-xs pt-1">{{ $message }}</p> @enderror
        </div>
        <div class="form-group">
            <label for="rw">RW</label>
            <input type="text" id="rw" name="rw" class="form-control" placeholder="Masukkan RW"
                value="{{ $poverty->rw ?? '' }}">
            @error('rw') <p class="text-danger text-xs pt-1">{{ $message }}</p> @enderror
        </div>
    </div>
</div>
<div class="col-md-6 form-group">
    <label for="kecamatan2">Kecamatan</label>
    <select class="form-select" id="kecamatan2">
        <option selected value="">-- Pilih kecamatan --</option>
        <input type="hidden" id="kecamatan" name="kecamatan" value="">
        <input type="hidden" id="id_kecamatan" name="id_kecamatan" value="">
    </select>
    @error('id_kecamatan') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
</div>


<div class="col-md-6 form-group">
    <label for="kelurahan">Desa</label>
    <select name="id_desa" class="form-select" id="kelurahan">
        <option selected value="">-- Pilih Desa --</option>
        <!-- load kelurahan/desa-->
    </select>
    @error('id_desa') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="tempat_lahir">TEMPAT LAHIR</label>
        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Masukan Tempat Lahir"
            value="{{ $poverty->tempat_lahir ?? '' }}">
        @error('tempat_lahir') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
    </div>
</div>

<div class="col-md-6">
    <div class="form-group">
        <label for="tgl">TANGGAL LAHIR</label>
        <input type="text" name="tgl" class="form-control datepicker py-2" placeholder="Masukan Tanggal Lahir"
            data-date-format="dd-mm-yyyy" value="{{ $poverty->tgl ?? '' }}">
        @error('tgl') <p class="text-danger text-xs pt-1">{{ $message }}</p> @enderror
    </div>
</div>

<div class="col-md-6 form-group">
    <label for="status">STATUS DALAM KELUARGA</label>
    <select name="status" class="form-select" id="status">
        <option selected value="">Pilih Status Keluarga</option>
        <option value="KEPALA KELUARGA" @if(isset($poverty) && $poverty->status === 'KEPALA KELUARGA') selected
            @endif>KEPALA KELUARGA</option>
        <option value="ANGGOTA KELUARGA" @if(isset($poverty) && $poverty->status === 'ANGGOTA KELUARGA') selected
            @endif>ANGGOTA KELUARGA</option>
    </select>
    @error('status') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="foto_diri">FOTO WAJAH</label><br>
            <input type="file" name="foto_diri" class="form-control-file" id="uploadFoto" accept=".jpg, .jpeg, .png"
                onchange="validateUpload(this)" value="{{ $poverty->foto_diri ?? '' }}">
            <small class="text-muted">Ukuran maksimum: 2MB</small>
        </div>
    </div>
    <div class="col-md-3">
        <div id="previewFoto"
            class="text-center border-dashed h-100 fs-6 d-flex align-items-center justify-content-center">
            <i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: 64px;"></i>
        </div>
    </div>
    <div class="col-md-5">
    </div>
</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     function validateUpload(input) {
        if (input.files && input.files[0]) {
            var file = input.files[0];
            var fileSize = file.size / 1024 / 1024; // Size in MB
            var validExtensions = ['jpg', 'jpeg', 'png'];
            var fileExtension = file.name.split('.').pop().toLowerCase();

            if (fileSize > 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ukuran file terlalu besar. Mohon pilih file dengan ukuran maksimum 2MB.'
                });
                input.value = ''; // Reset the input file
            } else if (!validExtensions.includes(fileExtension)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Format file tidak valid. Mohon pilih file dengan format JPG, JPEG, atau PNG.'
                });
                input.value = ''; // Reset the input file
            } else {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#previewFoto').html('<img src="' + e.target.result +
                        '" class="img-thumbnail" style="max-width: 200px;">');
                };
                reader.readAsDataURL(file);
            }
        }
    }

    function validateUpload2(input) {
    if (input.files && input.files.length > 0) {
        $('#previewFotoThumbnails').html(''); // Kosongkan area thumbnail sebelum menampilkan yang baru

        for (var i = 0; i < input.files.length; i++) {
            var file = input.files[i];
            var fileSize = file.size / 1024 / 1024; // Size in MB
            var validExtensions = ['jpg', 'jpeg', 'png'];
            var fileExtension = file.name.split('.').pop().toLowerCase();

            if (fileSize > 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ukuran file terlalu besar. Mohon pilih file dengan ukuran maksimum 2MB.'
                });
                input.value = ''; // Reset the input file
                return; // Keluar dari fungsi jika ada file yang tidak valid
            } else if (!validExtensions.includes(fileExtension)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Format file tidak valid. Mohon pilih file dengan format JPG, JPEG, atau PNG.'
                });
                input.value = ''; // Reset the input file
                return; // Keluar dari fungsi jika ada file yang tidak valid
            } else {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // Tampilkan preview foto sebagai thumbnail
                    var thumbnail = '<img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 100px;">';
                    $('#previewFotoThumbnails').append(thumbnail);
                };
                reader.readAsDataURL(file);
            }
        }
    }
}

$(document).ready(function () {

    var fotoDiri = '{{ $poverty->foto_diri ?? '' }}';
    
    if (fotoDiri) {
 
        var fotoUrl = '{{ asset("storage/foto_diri") }}/' + fotoDiri;
        $('#previewFoto').html('<img src="' + fotoUrl + '" class="img-thumbnail" style="max-width: 200px;">');
    } else {

        $('#previewFoto').html('<i class="fa fa-user-circle-o" aria-hidden="true" style="font-size: 64px;"></i>');
    }

    var fotoRumahs = {!! json_encode($poverty->foto_rumah ?? []) !!};

    if (typeof fotoRumahs === 'string') {
        // Convert string to array
        fotoRumahs = JSON.parse(fotoRumahs);
    }

    if (Array.isArray(fotoRumahs) && fotoRumahs.length > 0) {

        $('#previewFotoThumbnails').html('');

        // Tampilkan foto yang telah diunggah sebagai thumbnail
        fotoRumahs.forEach(function (fotoRumah) {
            var fotoUrl = '{{ asset("storage/foto_rumah") }}/' + fotoRumah;
            var thumbnail = '<div class="col-md-3"><a href="' + fotoUrl + '" target="_blank"><img src="' + fotoUrl + '" class="img-thumbnail" style="max-width: 100%; height: auto;"></a></div>';
            $('#previewFotoThumbnails').append(thumbnail);
        });
    } else {
        // Tampilkan placeholder atau ikon default
        $('#previewFotoThumbnails').html('<p>Tidak ada foto rumah</p>');
    }
});



</script>
@endpush


@push('css')
<style>
    .border-dashed {
        border: 0.5px dashed #ccc;
        padding: 5px;
    }

</style>
@endpush

@push('js')
<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });

</script>
@endpush



@push('js')
<script>
    var kecamatanSelect = document.getElementById('kecamatan2');
    var kelurahanSelect = document.getElementById('kelurahan');
    var kecamatanIdInput = document.getElementById('id_kecamatan');
    var kecamatanNameInput = document.getElementById('kecamatan');

    kecamatanSelect.addEventListener('change', function () {
        kelurahanSelect.innerHTML = '<option selected value="">-- Pilih Desa --</option>';

        var selectedKecamatan = kecamatanSelect.value;
        var selectedKecamatanName = kecamatanSelect.options[kecamatanSelect.selectedIndex].text;

        kecamatanIdInput.value = selectedKecamatan;
        kecamatanNameInput.value = selectedKecamatanName;

        if (selectedKecamatan) {
            // Fetch desa berdasarkan kecamatan yang dipilih
            fetch(`/poverty/getDesa/${selectedKecamatan}`)
                .then(response => response.json())
                .then(data => {
                    kelurahanSelect.innerHTML = '<option selected value="">-- Pilih Desa --</option>';

                    // Menambahkan opsi desa berdasarkan data yang diterima
                    data.forEach(desa => {
                        var option = document.createElement('option');
                        option.value = desa.id;
                        option.text = desa.name_desa;
                        kelurahanSelect.add(option);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

    // Mengambil data semua kecamatan dari database
    fetch('/poverty/getKecamatan')
        .then(response => response.json())
        .then(data => {
            kecamatanSelect.innerHTML = '<option selected value="">-- Pilih kecamatan --</option>';

            // Menambahkan opsi kecamatan berdasarkan data yang diterima
            data.data.forEach(kecamatan => {

                var option = document.createElement('option');
                option.value = kecamatan.id;
                option.text = kecamatan.name;
                kecamatanSelect.add(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
</script>
@endpush
