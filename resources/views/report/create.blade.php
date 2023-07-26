@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Buat Laporan'])
    <div class="row mt-4 mx-4">
        <div class="position-relative">
            <h5 class="text-white">Buat Laporan</h5>
            <div class="card px-5 py-3">
                <form action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="role">Role</div>
                                <select class="form-select" id="filter1" name="role" @if ($defaultRole === 'warga' || $defaultRole === 'skpd') disabled @endif>
                                    <option value="">Pilih Sebagai</option>
                                    <option value="warga" @if ($defaultRole === 'warga') selected @endif>Warga</option>
                                    <option value="skpd" @if ($defaultRole === 'skpd') selected @endif>SKPD</option>
                                </select>
                                @error('role')
                                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        @php
                            // If the default role is 'warga' or 'skpd', disable the user select input and select the current logged-in user
                            $isDisabled = ($defaultRole === 'warga' || $defaultRole === 'skpd') ? 'disabled' : '';
                        @endphp
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="user_id">Pelapor</div>
                                <select class="form-select selectName" id="filter2" name="user_id" {{ $isDisabled }}>
                                    @if ($defaultRole === 'warga' || $defaultRole === 'skpd')
                                        <option value="{{ Auth::id() }}" selected>{{ Auth::user()->name }}</option>
                                    @else
                                        <option value="">Pilih Pelapor</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                        
                                <!-- Add a hidden input field for role and user_id when the select elements are disabled -->
                                @if ($defaultRole === 'warga' || $defaultRole === 'skpd')
                                    <input type="hidden" name="role" value="{{ $defaultRole }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                @endif
                        
                                @error('user_id')
                                    <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12 rounded bg-primary p-1 my-3">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div for="nama_bantuan">Nama / Instansi Terlapor</div>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Masukan Nama / Instansi Terlapor">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div for="desc">Materi Yang Dilaporkan</div>
                                <textarea type="text" name="desc" class="form-control" placeholder="Masukan Materi Laporan"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="photos">Bukti Laporan</label>
                                <input type="file" name="photos[]" class="form-control" multiple>
                                <div class="preview"></div>
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
            $('.selectName').select2();
        });
    </script>

    <script>
        document.getElementById("filter1").addEventListener("change", function() {
            var role = this.value;
            var selectUser = document.getElementById("filter2");

            // Hapus semua opsi sebelumnya
            selectUser.innerHTML = '<option selected value="">Pilih Pelapor</option>';

            // Jika peran dipilih, lakukan permintaan Ajax untuk mendapatkan daftar pengguna berdasarkan peran
            if (role !== "") {
                fetch('/get-users-by-role/' + role)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(user => {
                            var option = document.createElement("option");
                            option.value = user.id;
                            option.text = user.name;
                            selectUser.appendChild(option);
                        });
                    });
            }
        });
    </script>

    <script>
        document.querySelector('input[name="photos[]"]').addEventListener('change', function(event) {
            var previewContainer = document.querySelector('.preview');
            previewContainer.innerHTML = ''; // Hapus pratinjau sebelumnya

            var files = event.target.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '200px';
                    img.style.margin = '5px';
                    previewContainer.appendChild(img);
                }

                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
