@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detail Jadwal Konsultasi'])

    <div class="row mt-4 mx-4">
        <div class="position-relative">
            <h5 class="text-white">Detail Jadwal Konsultasi</h5>
        </div>
    </div>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row justify-content-between">
                    <h5 class="card-title">Detail Jadwal Konsultasi</h5>
                    @can('admin-role')
                        <button type="button" class="btn btn-primary" id="tanggapiBtn">
                            Tanggapi
                        </button>
                    @endcan

                </div>
                <p class="card-text">Berikut adalah detail konsultasi:</p>
                <div class="row">
                    <div class="text-bold py-3">Informasi SKPD</div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div for="opd_id">SKPD/OPD</div>
                                <p class="text-bold">{{ $schedule->skpd->name ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div for="name">Nama Klien</div>
                                <p class="text-bold">{{ $schedule->name }}</p>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div for="phone">No Telpon Klien</div>
                                <p class="text-bold">{{ $schedule->phone }}</p>
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
                    @php
                        function getStatusLapor($status)
                        {
                            switch ($status) {
                                case 1:
                                    return 'Selesai';
                                case 2:
                                    return 'Perlu Ditanggapi';
                                case 3:
                                    return 'Akan Dihadiri';
                                case 4:
                                    return 'Dijadwalkan Ulang';
                                default:
                                    return 'Status Tidak Dikenali';
                            }
                        }
                    @endphp
                    <div class="col-md-6">
                        <div class="text-bold py-3">Jadwal Konsultasi</div>
                        <div class="col-md-12">
                            <div for="status">Status</div>
                            @php
                                $status = getStatusLapor($schedule->status);
                                $badgeClass = '';
                                
                                switch ($status) {
                                    case 'Selesai':
                                        $badgeClass = 'btn-success';
                                        break;
                                    case 'Perlu Ditanggapi':
                                        $badgeClass = 'btn-warning';
                                        break;
                                    case 'Akan Dihadiri':
                                        $badgeClass = 'btn-info';
                                        break;
                                    case 'Dijadwalkan Ulang':
                                        $badgeClass = 'btn-secondary';
                                        break;
                                    default:
                                        $badgeClass = 'btn-danger';
                                        break;
                                }
                            @endphp

                            <p class="text-bold btn {{ $badgeClass }}">{{ $status }}</p>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div for="konfirm-pass">Tipe Konsultasi</div>
                                <p class="text-bold">{{ $schedule->pertemuan ?? '-' }}</p>
                            </div>
                        </div>
                        @if ($schedule->respon_admin)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="konfirm-pass">Respon Admin</div>
                                    <p class="text-bold ">{{ $schedule->respon_admin }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12 form-group">
                            <div for="date">TANGGAL</div>
                            <p class="text-bold">{{ $schedule->date }}</p>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div for="konfirm-pass">WAKTU</div>
                                <p class="text-bold btn btn-success">{{ $schedule->time }}</p>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="place">Tempat Konsultasi</div>
                                    <p class="text-bold">{{ $schedule->place }}</p>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="place">Perihal Konsultasi</div>
                                    <p class="text-bold">{{ $schedule->about }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#surveyModal">
            Isi Survey
        </button> --}}

        <!-- Modal -->
        <div class="modal fade" id="surveyModal" tabindex="-1" role="dialog" aria-labelledby="surveyModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="surveyModalLabel">Survei Kepuasan</h5>
                    </div>
                    <div class="modal-body text-center">
                       
                        <div class="btn-group" role="group">
                            <div class="text-center">
                                <div class="mb-2">Sangat Puas</div>
                                <img src="{{ asset('img/sangatpuas.png') }}" alt="Sangat Puas" width="100"
                                    height="100" data-schedule-id="{{ $schedule->id }}" data-rating="1" class="close" data-dismiss="modal" aria-label="Close"> 
                            </div>
                            <div class="text-center">
                                <div class="mb-2">Puas</div>
                                <img src="{{ asset('img/puas.png') }}" alt="Puas" width="100" height="100"
                                    data-schedule-id="{{ $schedule->id }}" data-rating="2" class="close" data-dismiss="modal" aria-label="Close">
                            </div>
                            <div class="text-center">
                                <div class="mb-2">Tidak Puas</div>
                                <img src="{{ asset('img/tidakpuas.png') }}" alt="Tidak Puas" width="100"
                                    height="100" data-schedule-id="{{ $schedule->id }}" data-rating="3" class="close" data-dismiss="modal" aria-label="Close">
                            </div>
                            <div class="text-center">
                                <div class="mb-2">Sangat Tidak Puas</div>
                                <img src="{{ asset('img/sangattidakpuas.png') }}" width="100" height="100"
                                    data-schedule-id="{{ $schedule->id }}" data-rating="4" class="close" data-dismiss="modal" aria-label="Close">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
    @push('js')
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
        <script>
            document.getElementById("tanggapiBtn").addEventListener("click", function() {
                Swal.fire({
                    title: 'Update Status',
                    html: `
                <select id="status" class="form-control">
                    <option value="1">Selesai</option>
                    <option value="2">Perlu Ditanggapi</option>
                    <option value="3">Akan Dihadiri</option>
                    <option value="4">Dijadwalkan Ulang</option>
                </select>
                <label for="respon_admin">Respon Admin</label>
                <textarea id="respon_admin" class="form-control" placeholder="Masukkan respon admin" rows="3"></textarea>
            `,
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Close',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        const status = document.getElementById('status').value;
                        const responAdmin = document.getElementById('respon_admin').value;

                        // Submit form using fetch API
                        fetch("{{ route('schedule.updateStatus', $schedule->id) }}", {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    status: status,
                                    respon_admin: responAdmin
                                })
                            })
                            .then(response => {
                                if (response.ok) {
                                    // Hide SweetAlert and show success alert
                                    Swal.close();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Status berhasil diubah!',
                                        showConfirmButton: false,
                                        timer: 1500 // Duration of the success alert
                                    });

                                    // Delay reload after the SweetAlert is closed
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500); // Delay for 1.5 seconds before reloading
                                } else {
                                    // Show error alert if request failed
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Terjadi kesalahan saat mengubah status.',
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                // Show error alert if an error occurred
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Terjadi kesalahan saat mengubah status.',
                                });
                            });
                    },
                });
            });
        </script>
    @endpush
    @push('js')
        <script>
            $(document).ready(function() {
                $('#surveyModal img').click(function() {
                    var scheduleId = $(this).data('schedule-id');
                    var rating = $(this).data('rating');

                    $.ajax({
                        url: '{{ route('submit.survey') }}', // Ganti dengan URL yang sesuai
                        method: 'POST',
                        data: {
                            scheduleId: scheduleId,
                            rating: rating
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // console.log("berhasil");
                            $('#surveyModal').modal('hide');
                        },
                        error: function() {
                            console.log("tidak");
                            $('#surveyModal').modal('hide');
                            // Tampilkan pesan atau lakukan tindakan lain jika terjadi kesalahan
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {

                var surveyStatus = '{{ $schedule->survey_status ?? 0 }}';

                if (surveyStatus === '0') {
                    $('#surveyModal').modal('show');
                }

            });
        </script>
    @endpush
