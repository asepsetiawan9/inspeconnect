@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Ubah Laporan'])
    <div class="row mt-4 mx-4">
        <div class="position-relative">
            <h5 class="text-white">Ubah Laporan</h5>
            <div class="card px-5 py-3">
                <form action="{{ route('report.update', $report->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <div for="role">Role</div>
                            <select class="form-select" id="filter1" name="role">
                                <option value="warga" @if ($report->role === 'warga') selected @endif>Warga</option>
                                <option value="skpd" @if ($report->role === 'skpd') selected @endif>SKPD</option>
                            </select>
                            @error('role')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div for="user_id">Pelapor</div>
                            <select class="form-select selectName" id="filter2" name="user_id">
                                <option selected value="">Pilih Pelapor</option>
                                <!-- Loop through the users to select the current user -->
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @if ($user->id === $report->user_id) selected @endif>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <select class="form-select" id="lapor" name="pertemuan">
                        <option value="">Pilih Tipe Lapor</option>
                        <option value="Tatap Muka" {{ $report->pertemuan === "Tatap Muka" ? "selected" : "" }}>Tatap Muka</option>
                        <option value="Video Conference" {{ $report->pertemuan === "Video Conference" ? "selected" : "" }}>Video Conference</option>
                        <option value="Hanya Lapor" {{ $report->pertemuan === "Hanya Lapor" ? "selected" : "" }}>Hanya Lapor</option>
                    </select>
                    
                    
                    <div  id="formkontak" style="display: none;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div for="kontak">Kontak</div>
                                    <input type="text" name="kontak" class="form-control" placeholder="Kontak Yang Bisa Dihubungi" value="{{ $report->kontak ?? old('kontak') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                  <label for="datetime">Waktu dan Tanggal</label>
                                  <input type="text" id="datetime" name="datetime" class="form-control" placeholder="Waktu dan Tanggal" value="{{ $report->datetime ?? old('datetime') }}">
                                </div>
                              </div>
                              
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div for="tempat_bertemu">Tempat</div>
                                    <input type="text" name="tempat_bertemu" class="form-control" placeholder="Masukan Tempat" value="{{ $report->tempat_bertemu ?? old('tempat_bertemu') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 rounded bg-primary p-1 my-3">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_bantuan">Nama / Instansi Terlapor</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama / Instansi Terlapor" value="{{ $report->name ?? old('name') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="desc">Materi Yang Dilaporkan</label>
                            <textarea type="text" name="desc" class="form-control" placeholder="Masukan Materi Laporan">{{ $report->desc ?? old('desc') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="photos">Bukti Laporan</label>
                            <input type="file" name="photos[]" class="form-control" multiple>
                            <div class="preview">
                                @if ($report->photos && is_array($report->photos))
                                    @foreach ($report->photos as $photo)
                                        <div class="col-md-3">
                                            <div class="thumbnail">
                                                <img src="{{ asset('storage/report/' . $photo) }}" alt="Uploaded Photo">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Inisialisasi elemen select2
        $('.selectName').select2();
    });

    document.getElementById("filter1").addEventListener("change", function() {
        var role = this.value;
        var selectUser = document.getElementById("filter2");

        // Hapus semua opsi sebelumnya
        selectUser.innerHTML = '<option selected value="">Pilih Pelapor</option>';

        // Jika peran dipilih, lakukan permintaan Ajax untuk mendapatkan daftar pengguna berdasarkan peran
        if (role !== "") {
            fetch('/get-users-by-role/' + role)
                .then(response => response.json())
                .then(data => {
                    data.forEach(user => {
                        var option = document.createElement("option");
                        option.value = user.id; // Make sure the value represents the user ID
                        option.text = user.name;
                        selectUser.appendChild(option);
                    });
                });
        }
    });
</script>
<script>
    document.querySelector('input[name="photos[]"]').addEventListener('change', function(event) {
        var previewContainer = document.querySelector('.preview');
        previewContainer.innerHTML = ''; // Hapus pratinjau sebelumnya

        var files = event.target.files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '200px';
                img.style.margin = '5px';
                previewContainer.appendChild(img);
            }

            reader.readAsDataURL(file);
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var laporSelect = document.getElementById("lapor");
        var formKontak = document.getElementById("formkontak");

        function showFormKontak() {
            var selectedValue = laporSelect.value;
            if (selectedValue === "Tatap Muka" || selectedValue === "Video Conference") {
                formKontak.style.display = "block";
            } else {
                formKontak.style.display = "none";
            }
        }

        // Panggil fungsi showFormKontak saat halaman dimuat
        showFormKontak();

        // Panggil fungsi showFormKontak saat select berubah
        laporSelect.addEventListener("change", showFormKontak);
    });
</script>

<script>
    $(document).ready(function() {
      $("#datetime").datetimepicker({
        format: "Y-m-d H:i",
      });
    });
  </script>
@endpush
