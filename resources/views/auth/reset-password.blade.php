@extends('layouts.auth')
@section('content')
<div class="container d-flex flex-column">
    <div class="row vh-100">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
            <div class="d-table-cell align-middle">

                <div class="text-center mt-4">
                    <h1 class="h2">Reset Password</h1>
                    <p class="lead">
                        Masukkan Password Baru
                    </p>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-sm-3">
                            <form action="/password-reset" method="POST">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="phone" value="{{ $no_hp }}">
                               
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input class="form-control form-control-lg" type="password" name="password" id="password" placeholder="Password Baru"  required/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input class="form-control form-control-lg" type="password" name="password_confirmation" id="password" placeholder="Masukkan Password Baru"  required/>
                                </div>
                                    {{-- <input class="form-control form-control-lg" type="hidden" value="{{ $token }}" name="token" id="token" placeholder="Masukkan Password Baru"  /> --}}
                              
                                <div class="d-grid gap-2 mt-3">
                                    <button type="submit" class="btn btn-lg btn-primary">Reset password</button>
                                    
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