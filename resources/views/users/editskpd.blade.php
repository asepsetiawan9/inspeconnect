@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Ubah Data Pengguna'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Ubah Data SKPD</h5>
        <div class="card px-5 py-3">
            <form action="{{ route('user-management.updateskpd', $user->id) }}" method="POST">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="opd_id">SKPD/OPD</label>
                            <select name="opd_id" class="form-control selectOpd">
                                <option value="" selected disabled>-- Pilih SKPD/OPD --</option>
                                @foreach ($skpds as $skpd)
                                    <option value="{{ $skpd->id }}" {{ $user->opd_id == $skpd->id ? 'selected' : '' }}>{{ $skpd->name }}</option>
                                @endforeach
                            </select>
                            @error('opd_id') <p class="text-danger text-xs pt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="konfirm-pass">EMAIL</label>
                            <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" value="{{ old('email', $user->email) }}" >
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
