@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Management Data'])
<div class="row mt-4 mx-4">
    <div class="position-relative">
        <h5 class="text-white">Management Data</h5>
    </div>

    <div class="col-12">
    <div class="card mb-4">
        <div class="card-header pb-0">
            <h6>Import dan Export Data Kemiskinan</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <a href="{{ route('datamanagement.export') }}" class="btn btn-primary btn-md w-100">EXPORT</a>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('datamanagement.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input type="file" name="file" class="form-control">
                            <button type="submit" class="btn btn-success">Import</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="text-center">
                <p>Anda juga dapat mendownload template Excel untuk mengimpor data:</p>
                <a href="{{ route('datamanagement.downloadTemplate') }}" class="btn btn-secondary btn-sm">Download Template</a>
            </div>
        </div>
    </div>
</div>

</div>


</div>
@endsection
