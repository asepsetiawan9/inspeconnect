@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Tambah Data Pengguna'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Tambah Warga</h5>
        <div class="card px-5 py-3">
            <form action="{{ route('user-management.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">NO NIK</label>
                            <input type="number" name="nik" class="form-control" placeholder="Masukan No NIK" aria-label="Name" value="{{ old('nik') }}" >
                                        @error('nik') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">NAMA LENGKAP</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Lengkap" aria-label="Name" value="{{ old('name') }}" >
                                        @error('name') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">JENIS KELAMIN</label>
                            <select name="gender" class="form-control" aria-label="Gender">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('gender') <p class="text-danger text-xs pt-1"> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="jenis">TEMPAT LAHIR</label>
                        <input type="text" name="tempat" class="form-control " placeholder="Masukan Tempat Lahir"  aria-label="Lahir" value="{{ old('tempat') }}" >
                                        @error('tempat') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="kecamatan">TANGGAL LAHIR</label>
                        <input type="text" name="datebirth" class="form-control datepicker" placeholder="Tanggal Lahir" data-date-format="dd-mm-yyyy" aria-label="Name" value="{{ old('datebirth') }}" >
                                        @error('datebirth') <p class="text-danger text-xs pt-1"> {{ $message }} </p> @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="kelurahan">NO TELPON/HP</label>
                        <input type="text" name="telp" class="form-control" placeholder="Masukan No Telpon" aria-label="No Hp" value="{{ old('telp') }}" >
                                        @error('telp') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="password">ALAMAT LENGKAP</label>
                            <textarea type="text" name="address" class="form-control" placeholder="Masukan Alamat Lengkap" aria-label="Alamat" value="{{ old('address') }}" ></textarea>
                                        @error('address') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="konfirm-pass">EMAIL</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" value="{{ old('email') }}" >
                                        @error('email') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="konfirm-pass">PASSWORD</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                                        @error('password') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="flex flex-col mb-3 col-6">
                        <div class="custom-file">
                          <input type="file" name="photo" class="custom-file-input" id="customFile" aria-label="Photo">
                          <label class="custom-file-label" for="customFile">Unggal Foto KTP</label>
                        </div>
                        <div class="preview">
                          <img id="previewImage" class="preview-image" src="#" alt="Preview Foto" style="display: none;">
                        </div>
                        @error('photo') <p class="text-danger text-xs pt-1">{{ $message }}</p> @enderror
                    </div>
                    <input type="hidden" name="role" value="warga">
                    <input type="hidden" name="status" value="1">
                    <input type="hidden" name="opd_id" value="0">
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
<script>
    var kecamatanSelect = document.getElementById('kecamatan');
    var kelurahanSelect = document.getElementById('kelurahan');
    var kecamatanIdInput = document.getElementById('kecamatan_id');
    var kecamatanNameInput = document.getElementById('kecamatan_name');

    kecamatanSelect.addEventListener('change', function() {
        kelurahanSelect.innerHTML = '<option selected value="">-- Pilih Desa --</option>';

        var selectedKecamatan = kecamatanSelect.value;
        var selectedKecamatanName = kecamatanSelect.options[kecamatanSelect.selectedIndex].text;

        kecamatanIdInput.value = selectedKecamatan;
        kecamatanNameInput.value = selectedKecamatanName;

        if (selectedKecamatan) {
            // fetch desa
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${selectedKecamatan}.json`)
                .then(response => response.json())
                .then(villages => {
                    kelurahanSelect.innerHTML = '<option selected value="">-- Pilih Desa --</option>';

                    // list kelurahan/desa
                    villages.forEach(village => {
                        var option = document.createElement('option');
                        option.value = village.name;
                        option.text = village.name;
                        kelurahanSelect.add(option);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    });

    // ambil data smua kecamatan grt
    fetch('https://www.emsifa.com/api-wilayah-indonesia/api/districts/3205.json')
        .then(response => response.json())
        .then(districts => {
            kecamatanSelect.innerHTML = '<option selected value="">-- Pilih Kecamatan --</option>';

            districts.forEach(district => {
                var option = document.createElement('option');
                option.value = district.id;
                option.text = district.name;
                kecamatanSelect.add(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
</script>
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
<script>
    const fileInput = document.getElementById('customFile');
    const previewImage = document.getElementById('previewImage');
  
    fileInput.addEventListener('change', function() {
      const file = this.files[0];
  
      if (file) {
        const reader = new FileReader();
  
        reader.addEventListener('load', function() {
          previewImage.src = reader.result;
          previewImage.style.display = 'block';
        });
  
        reader.readAsDataURL(file);
      } else {
        previewImage.src = '#';
        previewImage.style.display = 'none';
      }
    });
  </script>
  
@endpush
@push("style")
<style>
    .custom-file-input {
      visibility: hidden;
      width: 0;
    }
  
    .custom-file-label {
      padding: 0.375rem 0.75rem;
      border-radius: 0.25rem;
      background-color: #e9ecef;
      color: #6c757d;
      cursor: pointer;
    }
  
    .preview-image {
      max-width: 100%;
      max-height: 200px;
      margin-top: 10px;
    }
  </style>
  
  
@endpush
