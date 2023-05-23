@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Tambah Data Pengguna'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Tambah Data Pengguna</h5>
        <div class="card px-5 py-3">
            <form action="{{ route('population-data.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_penduduk">Jumlah Penduduk</label>
                            <input type="number" id="jumlah_penduduk" name="jumlah_penduduk" class="form-control" placeholder="Jumlah Penduduk">
                            @error('jumlah_penduduk') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_kk">Jumlah KK</label>
                            <input type="number" id="jumlah_kk" name="jumlah_kk" class="form-control" placeholder="Jumlah KK">
                            @error('jumlah_kk') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_laki_laki">Jumlah Laki Laki</label>
                            <input type="number" id="jumlah_laki_laki" name="jumlah_laki_laki" class="form-control" placeholder="Jumlah Laki Laki">
                            @error('jumlah_laki_laki') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_perempuan">Jumlah Perempuan</label>
                            <input type="number" name="jumlah_perempuan" class="form-control" placeholder="Jumlah Perempuan">
                            @error('jumlah_perempuan') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="text" name="tahun" class="form-control datepicker" placeholder="Tahun" data-date-format="yyyy">
                            @error('tahun') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
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
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy',
            startView: 'years',
            minViewMode: 'years',
            autoclose: true
        });
    });
</script>
@endpush
