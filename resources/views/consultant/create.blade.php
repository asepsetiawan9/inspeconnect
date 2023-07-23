@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Tambah Data Konsultan'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Tambah Data Konsultan</h5>
        <div class="card px-5 py-3">
            <form action="{{ route('consultant.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">NAMA LENGKAP</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Lengkap" aria-label="Name" value="{{ old('name') }}" >
                                        @error('name') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                   
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender">JENIS KELAMIN</label>
                            <select name="gender" class="form-control" aria-label="Gender">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('gender') <p class="text-danger text-xs pt-1"> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6 form-group">
                        <label for="birth">TANGGAL LAHIR</label>
                        <input type="text" name="birth" class="form-control datepicker" placeholder="Tanggal Lahir" data-date-format="dd-mm-yyyy" aria-label="Name"  >
                                        @error('birth') <p class="text-danger text-xs pt-1"> {{ $message }} </p> @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="kelurahan">NO HP (Whatsapp)</label>
                        <input type="text" name="telp" class="form-control" placeholder="Masukan No Telpon" aria-label="No Hp" >
                                        @error('telp') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="jabatan">JABATAN</label>
                        <input type="text" name="jabatan" class="form-control" placeholder="Masukan Jabatan" aria-label="jabatan" >
                                        @error('jabatan') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="desc">Deskripsi Diri</label>
                            <textarea type="text" name="desc" class="form-control" placeholder="Masukan Alamat Lengkap" aria-label="Alamat" v ></textarea>
                                        @error('desc') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                        </div>
                    </div>
                    
                    
                    <div class="flex flex-col mb-3 col-6">
                        <div class="custom-file">
                          <input type="file" name="photo" class="custom-file-input" id="customFile" aria-label="Photo">
                          <label class="custom-file-label" for="customFile">Unggal Foto Diri</label>
                        </div>
                        <div class="preview">
                          <img id="previewImage" class="preview-image" src="#" alt="Preview Foto" style="display: none;">
                        </div>
                        @error('photo') <p class="text-danger text-xs pt-1">{{ $message }}</p> @enderror
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
