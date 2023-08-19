@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Detail Laporan'])
    <div class="row mt-4 mx-4">
        <div class="position-relative">
            <h5 class="text-white">Detail Laporan</h5>
            <div class="card px-5 py-3">
                <div class="row">
                    <div class="text-bold col-md-12">Data Pelapor</div>

                    @if ($report->role === 'warga')
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="role text-bold">NIK</div>
                                <div>{{ $report->user->nik ? $report->user->nik : '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="user_id text-bold">Nama Pelapor</div>
                                <div>{{ $report->user->name ? $report->user->name : '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="user_id text-bold">Jenis Kelamin</div>
                                <div>{{ $report->user->gender ? $report->user->gender : '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="user_id text-bold">No Telpon</div>
                                <div>{{ $report->user->phone ? $report->user->phone : '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="user_id text-bold">Email</div>
                                <div>{{ $report->user->address ? $report->user->address : '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="user_id text-bold">Alamat</div>
                                <div>{{ $report->address ? $report->address : '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="user_id" class="font-weight-bold">Status</div>
                                @php
                                    $statusLabel = '-';
                                    $statusClass = 'btn-secondary';
                                    $isAdmin = Auth::user()->role === 'admin';
                                    switch ($report->status) {
                                        case 1:
                                            $statusLabel = 'Selesai';
                                            $statusClass = 'btn-success';
                                            break;
                                        case 2:
                                            $statusLabel = 'Perlu di Tindak Lanjuti';
                                            $statusClass = 'btn-warning';
                                            break;
                                        case 3:
                                            $statusLabel = 'Diproses';
                                            $statusClass = 'btn-primary';
                                            break;
                                        case 4:
                                            $statusLabel = 'Tidak di Tindak Lanjuti';
                                            $statusClass = 'btn-danger';
                                            break;
                                        default:
                                            // Do nothing
                                    }
                                @endphp
                        
                                @if ($isAdmin)
                                    <button class="btn {{ $statusClass }} text-capitalize" id="updateStatusBtn">{{ $statusLabel }}</button>
                                @else
                                    <div class="btn {{ $statusClass }} text-capitalize">{{ $statusLabel }}</div>
                                @endif
                            </div>
                        </div>
                        @if ($report->respon_admin)
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div for="user_id text-bold">Respon Admin</div>
                                    <div>{{ $report->respon_admin ? $report->respon_admin : '-' }}</div>
                                </div>
                            </div>
                        @else
                            
                        @endif
                        
                        
                        
                        <div class="col-md-6">
                            <div class="ktp-photo-container">
                                @if ($report->user->photo)
                                    <a href="{{ asset('storage/' . $report->user->photo) }}" data-toggle="lightbox"
                                        data-gallery="ktp-gallery">
                                        <img src="{{ asset('storage/' . $report->user->photo) }}" class="img-thumbnail">
                                    </a>
                                @else
                                    <p>KTP photo available</p>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="user_id text-bold">Nama Pelapor</div>
                                <div>{{ $report->user->name ? $report->user->name : '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="user_id text-bold">Email</div>
                                <div>{{ $report->user->address ? $report->user->address : '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="user_id text-bold">Alamat</div>
                                <div>{{ $report->user->address ? $report->address : '-' }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="user_id" class="font-weight-bold">Status</div>
                                @php
                                    $statusLabel = '-';
                                    $statusClass = 'btn-secondary';
                                    switch ($report->status) {
                                        case 1:
                                            $statusLabel = 'Selesai';
                                            $statusClass = 'btn-success';
                                            break;
                                        case 2:
                                            $statusLabel = 'Perlu di Tindak Lanjuti';
                                            $statusClass = 'btn-warning';
                                            break;
                                        case 3:
                                            $statusLabel = 'Diproses';
                                            $statusClass = 'btn-primary';
                                            break;
                                        case 4:
                                            $statusLabel = 'Tidak di Tindak Lanjuti';
                                            $statusClass = 'btn-danger';
                                            break;
                                        default:
                                            // Do nothing
                                    }
                                @endphp
                                <button class="btn {{ $statusClass }} text-capitalize" id="updateStatusBtn">{{ $statusLabel }}</button>
                            </div>
                        </div>
                        @if ($report->respon_admin)
                        <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div for="user_id " class="text-bold">Respon Admin</div>
                                    <div>{{ $report->respon_admin ? $report->respon_admin : '-' }}</div>
                                </div>
                            </div>
                        @else
                            
                        @endif
                    @endif

                    <div class="col-md-12 bg-primary p-1 my-3">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 row">
                            <div class="text-bold col-md-12">
                                Data Terlapor
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="nama_bantuan" class="text-bold">Nama / Instansi Terlapor</div>
                                    <div>{{ $report->name ? $report->name : '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="desc" class="text-bold">Materi Yang Dilaporkan</div>
                                    <div>{{ $report->desc ? $report->desc : '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="uploaded-photos-container">
                                    <div class="text-bold">Bukti Laporan</div>
                                    <div class="row">
                                        @if (!empty($report->photos))
                                            @php
                                                $photos = json_decode($report->photos);
                                            @endphp
                                            @foreach ($photos as $photo)
                                                <div class="col-md-3">
                                                    <div class="thumbnail">
                                                        <a href="{{ asset('storage/report/' . $photo) }}" target="_blank">
                                                            <img src="{{ asset('storage/report/' . $photo) }}" alt="Uploaded Photo">
                                                        </a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                            
                                        @if (!empty($report->files))
                                            @php
                                                $files = json_decode($report->files);
                                            @endphp
                                            @foreach ($files as $file)
                                                <div class="col-md-3">
                                                    <div class="thumbnail">
                                                        @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                                            <a href="{{ asset('storage/report/' . $file) }}" target="_blank">
                                                                <img src="{{ asset('storage/report/' . $file) }}" alt="Uploaded Photo">
                                                            </a>
                                                        @else
                                                            <a href="{{ asset('storage/report/' . $file) }}" target="_blank" download>
                                                                <i class="far fa-file-pdf"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                        </div>
                        <div class="col-md-6 row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="pertemuan" class="text-bold">Tipe Lapor</div>
                                    <div>{{ $report->pertemuan ? $report->pertemuan : '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="kontak" class="text-bold">Kontak Pelapor</div>
                                    <div>{{ $report->kontak ? $report->kontak : '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="datetime" class="text-bold">Jam dan Tanggal</div>
                                    <div>{{ $report->datetime ? $report->datetime : '-' }}</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div for="tempat_bertemu" class="text-bold">Tempat</div>
                                    <div>{{ $report->tempat_bertemu ? $report->tempat_bertemu : '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
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
                            height="100" data-report-id="{{ $report->id }}" data-rating="1" class="close" data-dismiss="modal" aria-label="Close"> 
                    </div>
                    <div class="text-center">
                        <div class="mb-2">Puas</div>
                        <img src="{{ asset('img/puas.png') }}" alt="Puas" width="100" height="100"
                            data-report-id="{{ $report->id }}" data-rating="2" class="close" data-dismiss="modal" aria-label="Close">
                    </div>
                    <div class="text-center">
                        <div class="mb-2">Tidak Puas</div>
                        <img src="{{ asset('img/tidakpuas.png') }}" alt="Tidak Puas" width="100"
                            height="100" data-report-id="{{ $report->id }}" data-rating="3" class="close" data-dismiss="modal" aria-label="Close">
                    </div>
                    <div class="text-center">
                        <div class="mb-2">Sangat Tidak Puas</div>
                        <img src="{{ asset('img/sangattidakpuas.png') }}" width="100" height="100"
                            data-report-id="{{ $report->id }}" data-rating="4" class="close" data-dismiss="modal" aria-label="Close">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
    {{-- <form id="updateStatusForm" method="POST" style="display: none;">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option value="1">Selesai</option>
                <option value="2">Tidak di Tindak Lanjuti</option>
                <option value="3">Diproses</option>
            </select>
        </div>
    </form> --}}
@endsection

@section('scripts')
    <!-- Add this script to enable Bootstrap Lightbox -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script>
        $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    </script>
@endsection

@push('style')
    <!-- Add custom CSS styles -->
    <style>
        .ktp-photo-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .img-thumbnail {
            max-width: 200px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .img-thumbnail:hover {
            transform: scale(1.1);
        }

        .uploaded-photos-container {
            margin-top: 20px;
        }

        .thumbnail img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endpush

@push('js')
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
<script>
    document.getElementById("updateStatusBtn").addEventListener("click", function() {
        Swal.fire({
            title: 'Update Status',
            html: `
                <label for="status">Status</label>
                <select id="status" class="form-control">
                    <option value="2">Perlu Di Tindak Lanjuti</option>
                    <option value="1">Selesai</option>
                    <option value="3">Diproses</option>
                    <option value="4">Tidak Ditindak Lanjuti</option>
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
                fetch("{{ route('report.updateStatus', $report->id) }}", {
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
                            timer: 2000 // Duration of the success alert (3 seconds)
                        });
                        // Reload the page to see the updated status
                        setTimeout(() => {
                            location.reload();
                        }, 2000); 
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
@push('js')
        <script>
            $(document).ready(function() {
                $('#surveyModal img').click(function() {
                    var reportId = $(this).data('report-id');
                    var rating = $(this).data('rating');

                    $.ajax({
                        url: '{{ route('submit.surveyReport') }}',
                        method: 'POST',
                        data: {
                            reportId: reportId,
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
                var userRole = '{{ Auth::user()->role }}'; // Ganti dengan cara Anda untuk mengakses peran pengguna
                var surveyStatus = '{{ $report->survey_status ?? 0 }}';

                if ((userRole === 'skpd' || userRole === 'warga') && surveyStatus === '0') {
                    $('#surveyModal').modal('show');
                }
            });

        </script>
@endpush