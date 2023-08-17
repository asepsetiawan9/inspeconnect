@extends('layouts.app')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <div class="d-flex justify-content-center align-center mt-5">
                            {{-- <img src="{{ asset('img/favicon.png') }}" alt="Gambar"> --}}
                            <img src="{{ asset('img/ekliwas.png') }}"   alt="logo" class="w-30 h-30 ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-7 col-lg-6 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Daftar Warga</h5>
                        </div>
                        
                        <div class="card-body">
                            <form method="POST" action="{{ route('register.perform') }}"  enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="flex flex-col mb-3 col-6">
                                        <input type="number" name="nik" class="form-control" placeholder="Masukan No NIK" aria-label="Name" value="{{ old('nik') }}" >
                                        @error('nik') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3 col-6">
                                        <input type="text" name="name" class="form-control" placeholder="Masukan Nama Lengkap" aria-label="Name" value="{{ old('name') }}" >
                                        @error('name') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3 col-6">
                                        <select name="gender" class="form-control" aria-label="Gender">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-Laki">Laki-Laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                        @error('gender') <p class="text-danger text-xs pt-1"> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3 col-6">
                                        <input type="text" name="tempat" class="form-control " placeholder="Masukan Tempat Lahir"  aria-label="Lahir" value="{{ old('tempat') }}" >
                                        @error('tempat') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3 col-6">
                                        <input type="text" name="datebirth" class="form-control datepicker" placeholder="Tanggal Lahir" data-date-format="dd-mm-yyyy" aria-label="Name" value="{{ old('datebirth') }}" >
                                        @error('datebirth') <p class="text-danger text-xs pt-1"> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3 col-6">
                                        <input type="text" name="telp" class="form-control" placeholder="Masukan No Telpon" aria-label="No Hp" value="{{ old('telp') }}" >
                                        @error('telp') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3 col-12">
                                        <textarea type="text" name="address" class="form-control" placeholder="Masukan Alamat Lengkap" aria-label="Alamat" value="{{ old('address') }}" ></textarea>
                                        @error('address') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    
                                    <div class="flex flex-col mb-3 col-6">
                                        <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" value="{{ old('email') }}" >
                                        @error('email') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3 col-6">
                                        <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                                        @error('password') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                    </div>
                                    <div class="flex flex-col mb-3 col-6">
                                        <div class="custom-file">
                                          <input type="file" name="photo" class="custom-file-input" id="customFile" aria-label="Photo">
                                          <label class="custom-file-label" for="customFile">Unggal Foto KTP</label>
                                        </div>
                                        <div class="preview">
                                          <img id="previewImage" class="preview-image" src="#" alt="Preview Foto" style="display: none;">
                                        </div>
                                        @error('photo') <p class="text-danger text-xs pt-1">{{ $message }}</p> @enderror
                                      </div>
                                </div>
                                <input type="hidden" name="role" value="warga">
                                <input type="hidden" name="status" value="0">
                                <input type="hidden" name="opd_id" value="0">
                                <div class="form-check form-check-info text-start">
                                    <input class="form-check-input" type="checkbox" name="terms" id="flexCheckDefault" >
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and
                                            Conditions</a>
                                    </label>
                                    @error('terms') <p class='text-danger text-xs'> {{ $message }} </p> @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}"
                                        class="text-dark font-weight-bolder">Sign in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.footers.guest.footer')
@endsection

@push('js')
<script>
    $(document).ready(function () {
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
  
@endpush
@push("style")
<style>
    .custom-file-input {
      visibility: hidden;
      width: 0;
    }
  
    .custom-file-label {
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

