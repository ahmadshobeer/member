@extends('layouts.auth')
@section('content')
<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2">Reset password</h1>
                    <p class="lead">
                        Masukkan No HP yang terdaftar
                    </p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-3">
                            <form action="/forgot-password" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">No HP</label>
                                    <input class="form-control form-control-lg" type="text" name="phone" id="phone" placeholder="Masukkan nomer HP" />
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary">Reset password</button>
                                    {{-- <a class='btn btn-lg btn-primary' href='/'>Reset password</a> --}}
                                </div>
                            </form>
                        </div>
                            @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <div class="alert-message">
                                    <ul> 
                                        @foreach ($errors->all() as $error)
                                        <li> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <div class="alert-message">
                                    <span>{{session('status')}}</span>
                                </div>
                                
                            </div>
                        @endif
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection