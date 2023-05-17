@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Data Kemiskinan'])
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-xl-12 col-sm-12 card">
            <article>

                <h1>We&rsquo;ll be back soon!</h1>
                <div>
                    <p>Page Under Maintenance</p>
                </div>
            </article>
        </div>
    </div>
</div>
@include('layouts.footers.auth.footer')
</div>
@endsection
