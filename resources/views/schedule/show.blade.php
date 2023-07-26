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
            <p class="card-text">Berikut adalah detail konsultan:</p>
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
                        function getStatusText($status) {
                            switch ($status) {
                                case 1:
                                    return 'Perlu Ditanggapi';
                                case 2:
                                    return 'Selesai';
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
                            <div class="form-group">
                                <div for="konfirm-pass">Status</div>
                                <p class="text-bold btn btn-success">{{ getStatusText($schedule->status) }}</p>
                               
                            </div>
                        </div>
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
                                <p class="text-bold">{{ $schedule->about }}</p>
                            </div>
                            
                        </div>
                        </div>
                    </div>
        </div>
    </div>
</div>

@endsection
 @push('js')
 <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
 <script>
    document.getElementById("tanggapiBtn").addEventListener("click", function() {
        Swal.fire({
            title: 'Update Status',
            input: 'select',
            inputOptions: {
                1: 'Perlu Ditanggapi',
                2: 'Selesai',
                3: 'Akan Dihadiri',
                4: 'Dijadwalkan Ulang',
            },
            inputPlaceholder: 'Pilih status...',
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Close',
            showLoaderOnConfirm: true,
            preConfirm: (status) => {
                if (!status) {
                    Swal.showValidationMessage(`Status harus dipilih`);
                }
                // Submit form here
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('schedule.updateStatus', $schedule->id) }}";
                var csrfField = document.createElement('input');
                csrfField.type = 'hidden';
                csrfField.name = '_token';
                csrfField.value = "{{ csrf_token() }}";
                form.appendChild(csrfField);
                var methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'PUT';
                form.appendChild(methodField);
                var statusField = document.createElement('input');
                statusField.type = 'hidden';
                statusField.name = 'status';
                statusField.value = status;
                form.appendChild(statusField);
                document.body.appendChild(form);

                // Submit form using fetch API
                fetch(form.action, {
                    method: form.method,
                    body: new FormData(form),
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
