@extends('layouts.auth')
@section('content')
<div class="container d-flex flex-column">
    {{-- <div class="container d-flex flex-column"> --}}
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center">
                        <h1 class="display-1 fw-bold">500</h1>
                        <p class="h2">Internal server error.</p>
                        <p class="lead fw-normal mt-3 mb-4">Kesalahan dari server.</p>
                        <a class='btn btn-primary btn-lg' href='/'>Return to website</a>
                    </div>

                </div>
            </div>
        </div>
    {{-- </div> --}}
</div>
@endsection