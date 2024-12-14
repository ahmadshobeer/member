@extends('layouts.layout')

@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3">Settings</h1>

    <div class="row">
        <div class="col-md-3 col-xl-2">

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Settings</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action " data-bs-toggle="list" href="#account" role="tab">
                        Account
                    </a>
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#password" role="tab">
                        Password
                    </a>
                    
                </div>
            </div>
        </div>

        <div class="col-md-9 col-xl-10">
            <div class="tab-content">
                <div class="tab-pane fade " id="account" role="tabpanel">

                    <div class="card">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Public info</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">No Telp</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}" placeholder="Username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Biography</label>
                                            <textarea rows="2" class="form-control" id="inputBio"
                                                placeholder="Tell something about yourself"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <img alt="Charles Hall" src="{{ asset('img/avatars/avatar.jpg') }}" class="rounded-circle img-responsive mt-2"
                                                width="128" height="128" />
                                            <div class="mt-2">
                                                <span class="btn btn-primary"><i class="fas fa-upload"></i> Upload</span>
                                            </div>
                                            <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>

                        </div>
                    </div>


                </div>
                <div class="tab-pane fade show active" id="password" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Password</h5>
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="alert-message">
                                    {{ session('success') }}
                                </div>
                            </div>
                                {{-- <p style="color: green;"></p> --}}
                            @endif
                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="inputPasswordCurrent">Current password</label>
                                    <input type="password" class="form-control" name="current_password" id="inputPasswordCurrent">
                                    @error('current_password')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                    <small><a href="#">Forgot your password?</a></small>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputPasswordNew">New password</label>
                                    <input type="password" class="form-control" name="new_password" id="inputPasswordNew">
                                    @error('new_password')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputPasswordNew2">Verify password</label>
                                    <input type="password" class="form-control" name="new_password_confirmation" id="inputPasswordNew2">
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

