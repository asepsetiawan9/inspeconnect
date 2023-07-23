@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Pilih Konsultan'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Pilih Konsultan</h5>
        <div class="card px-5 py-3">
            <div class="row gap-2">
                @if ($consultants->isEmpty())
                    <div class="text-center" colspan="6">Data tidak ditemukan.</div>
                @else
                @foreach ($consultants as $consultant)
                <div class="col-12 col-md-6 col-lg-3 d-flex flex-column align-items-center border ">
                    <div class="rounded-circle overflow-hidden mt-3" style="width: 150px; height: 150px;">
                        <img src="{{ asset('storage/' . $consultant->photo) }}" alt="Foto Konsultan" class="w-100 h-100 object-cover" style="object-fit: cover;">
                    </div>
                    <div class="py-2">
                        <div class="fw-bold text-center text-uppercase">
                            {{ $consultant->name ? $consultant->name : " " }}
                        </div>
                        <div class="fw-light text-center text-uppercase">
                            {{ $consultant->jabatan ? $consultant->jabatan : " " }}
                        </div>
                    </div>
                    <div class="mt-3 d-flex flex-col gap-2">
                        <a href="{{ route('schedule.createschedule', ['consultant_id' => $consultant->id]) }}" class="btn btn-primary">
                            Konsultasi
                        </a>
                        <a href="https://api.whatsapp.com/send?phone={{ $consultant->telp }}" class="btn btn-whatsapp">
                            Whatsapp
                        </a>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
.btn-whatsapp {
    background-color: #7A9D54; /* Replace #00FF00 with your desired hex color */
    color: #FFFFFF; /* Optionally, you can also set the text color to white for better contrast */
}
</style>
@endpush