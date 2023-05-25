@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Ubah Data Kemiskinan'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Ubah Data Kemiskinan</h5>
        <div class="card px-5 py-3">
            <div class="d-flex flex-row justify-content-center gap-3">
                <div class="d-flex flex-column align-items-center cursor-pointer">
                    <div class="text-bold text-white rounded-circle bg-primary px-3 pt-3 text-center"
                        style="width: 50px; height: 50px;">1
                    </div>
                    <div class="text-sm">Halaman 1</div>
                </div>
                <div class="d-flex flex-column align-items-center cursor-pointer">
                    <div class="text-bold text-white rounded-circle bg-primary px-3 py-3 text-center"
                        style="width: 50px; height: 50px;">2
                    </div>
                    <div class="text-sm">Halaman 2</div>
                </div>
                <div class="d-flex flex-column align-items-center cursor-pointer">
                    <div class="text-bold text-white rounded-circle bg-primary px-3 py-3 text-center"
                        style="width: 50px; height: 50px;">3
                    </div>
                    <div class="text-sm">Halaman 3</div>
                </div>
            </div>


            <form id="poverty-form" action="{{ route('poverty.update', $poverty->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div id="form-1" class="form-section row pt-3">
                        @include('poverty.1')
                        <div class="d-flex flex-row justify-content-end">
                            <div class="btn btn-primary cursor-pointer" id="next-btn-1">Selanjutnya</div>
                        </div>
                    </div>

                    <div id="form-2" class="form-section row pt-3">
                        @include('poverty.2')
                        <div class="d-flex flex-row justify-content-between">
                            <div class="btn btn-warning cursor-pointer" id="prev-btn-2">Sebelumnya</div>
                            <div class="btn btn-primary cursor-pointer" id="next-btn-2">Selanjutnya</div>
                        </div>

                    </div>

                    <div id="form-3" class="form-section row pt-3">
                        @include('poverty.3')
                        <div class="d-flex flex-row justify-content-between">
                            <div class="btn btn-warning cursor-pointer" id="prev-btn-3">Sebelumnya</div>
                            <button type="submit" class="btn btn-secondary">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        // Sembunyikan semua form kecuali form pertama
        $('.form-section').hide();
        $('#form-1').show();

        // Atur tampilan form saat halaman di klik
        $('.d-flex.flex-column.align-items-center').on('click', function () {
            var formId = $(this).find('.text-bold').text();
            $('.form-section').hide();
            $('#form-' + formId).show();
        });

        // Navigasi ke halaman sebelumnya
        $('#prev-btn-2').on('click', function () {
            var currentForm = $('.form-section:visible');
            var prevForm = currentForm.prev('.form-section');
            if (prevForm.length > 0) {
                currentForm.hide();
                prevForm.show();
            }
        });

        $('#prev-btn-3').on('click', function () {
            var currentForm = $('.form-section:visible');
            var prevForm = currentForm.prev('.form-section');
            if (prevForm.length > 0) {
                currentForm.hide();
                prevForm.show();
            }
        });

        // Navigasi ke halaman selanjutnya
        $('#next-btn-1').on('click', function () {
            var currentForm = $('.form-section:visible');
            var nextForm = currentForm.next('.form-section');
            if (nextForm.length > 0) {
                currentForm.hide();
                nextForm.show();
            }
        });

        $('#next-btn-2').on('click', function () {
            var currentForm = $('.form-section:visible');
            var nextForm = currentForm.next('.form-section');
            if (nextForm.length > 0) {
                currentForm.hide();
                nextForm.show();
            }
        });

        // Inisialisasi datepicker
        $('.datepicker').datepicker({
            format: 'yyyy',
            startView: 'years',
            minViewMode: 'years',
            autoclose: true
        });
    });

</script>
@endpush
