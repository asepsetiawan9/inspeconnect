@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Tambah Data Pengguna'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Tambah Data Pengguna</h5>
        <div class="card px-5 py-3">
            <form action="{{ route('user-management.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">NAMA PENGGUNA</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Nama Pengguna">
                            @error('username') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                            @error('email') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone">NO. HP</label>
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="No Telpon">
                            @error('phone') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="jenis">JENIS</label>
                        <select name="role" class="form-select" id="jenis">
                            <option selected value="admin">Administrator</option>
                            <option value="kec">Admin Kecamatan</option>
                            <option value="des">Admin Desa</option>
                        </select>
                        @error('role') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="kecamatan">KECAMATAN</label>
                        <select class="form-select" id="kecamatan">
                            <option selected value="">-- Pilih Kecamatan --</option>
                            <input type="hidden" id="kecamatan_name" name="kecamatan_name" value="">
                            <input type="hidden" id="kecamatan_id" name="kecamatan_id" value="">
                            <!-- load kecamatan -->
                        </select>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="kelurahan">Desa</label>
                        <select name="desa" class="form-select" id="kelurahan">
                            <option selected value="">-- Pilih Desa --</option>
                            <!-- load kelurahan/desa-->
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                            @error('password') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="konfirm-pass">Konfirmasi Password</label>
                            <input type="password" name="konfirm-pass" class="form-control" placeholder="Konfirmasi Password" aria-label="Password">
                            @error('konfirm-pass') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
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
