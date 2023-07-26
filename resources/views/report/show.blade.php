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
                                            $statusLabel = 'Belum Dilihat';
                                            $statusClass = 'btn-warning';
                                            break;
                                        case 3:
                                            $statusLabel = 'Diproses';
                                            $statusClass = 'btn-primary';
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
                                            $statusLabel = 'Belum Dilihat';
                                            $statusClass = 'btn-warning';
                                            break;
                                        case 3:
                                            $statusLabel = 'Diproses';
                                            $statusClass = 'btn-primary';
                                            break;
                                        default:
                                            // Do nothing
                                    }
                                @endphp
                                <button class="btn {{ $statusClass }} text-capitalize" id="updateStatusBtn">{{ $statusLabel }}</button>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-12 bg-primary p-1 my-3">
                    </div>
                    <div class="text-bold col-md-12">
                        Data Terlapor
                    </div>
                    <div class="col-md-6">
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
                                                <img src="{{ asset('storage/report/' . $photo) }}" alt="Uploaded Photo">
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>No photos available</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <form id="updateStatusForm" method="POST" style="display: none;">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status" id="status">
                <option value="1">Selesai</option>
                <option value="2">Belum Dilihat</option>
                <option value="3">Diproses</option>
            </select>
        </div>
    </form>
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
            input: 'select',
            inputOptions: {
                1: 'Selesai',
                2: 'Belum Dilihat',
                3: 'Diproses',
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
                form.action = "{{ route('report.updateStatus', $report->id) }}"; // Replace with your route for updating the status
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
                        // Reload the page to see the updated status
                        location.reload();
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