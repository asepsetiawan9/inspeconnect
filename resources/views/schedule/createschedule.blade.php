@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Buat Jadwal Konsultasi'])
    <div class="row mt-4 mx-4">
        <div class="position-relative">
            <h5 class="text-white"> Buat Jadwal Konsultasi</h5>
            <div class="card px-5 py-3">
                <form action="{{ route('schedule.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="text-bold py-3">Informasi SKPD</div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="opd_id">SKPD/OPD</div>
                                    @if ($userRole === 'skpd')
                                        <input type="hidden" name="opd_id" value="{{ auth()->user()->opd_id }}">
                                    @endif
                                    <select name="opd_id" class="form-control selectOpd" @if ($userRole === 'skpd') disabled @endif>
                                        @foreach ($skpds as $skpd)
                                            <option value="{{ $skpd->id }}"
                                                @if ($userRole === 'skpd' && $skpd->id == auth()->user()->opd_id) selected @endif>
                                                {{ $skpd->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('opd_id')
                                        <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="konfirm-pass">Nama Klien</div>
                                    <input type="name" name="name" class="form-control" placeholder="Nama Klien"
                                        aria-div="Email">
                                    @error('name')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="konfirm-pass">No Telpon Klien</div>
                                    <input type="phone" name="phone" class="form-control" placeholder="No Telpon Klien"
                                        aria-div="phone">
                                    @error('phone')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6"></div>
                        <div class="text-bold py-3">Informasi Konsultan</div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="konfirm-pass">Nama Konsultan</div>
                                    <p class="text-bold">{{ $consultant->name ? $consultant->name : '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="konfirm-pass">No Telpon Konsultan</div>
                                    <p class="text-bold">{{ $consultant->telp ? $consultant->telp : '-' }}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="konfirm-pass">Jabatan Konsultan</div>
                                    <p class="text-bold">{{ $consultant->jabatan ? $consultant->jabatan : '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="text-bold py-3">Jadwal Konsultasi</div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="konsul">Pilih Konsultasi</div>
                                    <select class="form-select" id="lapor" name="pertemuan">
                                        <option value="">Pilih Konsultasi</option>
                                        <option value="Tatap Muka">Tatap Muka</option>
                                        <option value="Video Conference">Video Conference</option>
                                        <option value="Konsultasi Online">Konsultasi Online</option>
                                    </select>
                                    @error('pertemuan')
                                        <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <div for="date">TANGGAL</div>
                                <input type="text" name="date" class="form-control datepicker"
                                    placeholder="Tanggal Konsultasi" data-date-format="dd-mm-yyyy" aria-label="Name">
                                @error('date')
                                    <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="konfirm-pass">WAKTU</div>
                                    @php
                                        // Array of time options
                                        $timeOptions = ['09:00', '10:00', '13:00', '15:00'];
                                        // Time value from the database, e.g., '09:00'
                                        $selectedTime = $consultant->time ?? ''; // Replace 'consultant' with the appropriate variable holding the model data
                                    @endphp

                                    <div>
                                        @foreach ($timeOptions as $time)
                                            <input type="radio" id="time-{{ $time }}" name="time"
                                                class="btn-check" value="{{ $time }}"
                                                @if ($selectedTime === $time) checked @endif>
                                            <label class="btn btn-outline-primary"
                                                for="time-{{ $time }}">{{ $time }}</label>
                                        @endforeach
                                    </div>

                                </div>
                                @error('time')
                                    <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="konfirm-pass">Tempat Konsultasi</div>
                                    <input type="place" name="place" class="form-control"
                                        placeholder="Masukan Tempat Konsultasi" aria-div="place">
                                    @error('place')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="konfirm-pass">Perihal Konsultasi</div>
                                    <input type="about" name="about" class="form-control"
                                        placeholder="Masukan Perihal Konsultasi" aria-div="about">
                                    @error('about')
                                        <p class='text-danger text-xs pt-1'> {{ $message }} </p>
                                    @enderror
                                </div>
                                <input type="hidden" name="consultant_id" value="{{ $consultant->id }}">
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi elemen select2
            $('.selectOpd').select2();
        });
    </script>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
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

    <script>
        $(document).ready(function() {
            $("#datetime").datetimepicker({
                format: "Y-m-d H:i",
            });
        });
    </script>
@endpush
@push('style')
    <style>
        .custom-file-input {
            visibility: hidden;
            width: 0;
        }

        .custom-file-div {
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
