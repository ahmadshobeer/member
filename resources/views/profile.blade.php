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
                            <form id="avatar-form" enctype="multipart/form-data" action="{{ route('avatar.update') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">No Telp</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}" placeholder="Username" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Paket Langganan</label>
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $tarif->nm_paket }}" placeholder="Username" readonly>
                                            {{-- <input type="text" class="form-control" id="desk_paket" name="desk_paket" value="" placeholder="Nama Paket" readonly> --}}
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Ganti Foto</label>
                                            <input type="file" class="form-control" id="avatar" name="avatar"  placeholder="File gambar" required>
                                            <small>Maksimal 2MB</small>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <img alt="{{ $nm_pelanggan }}" src="{{ auth()->user()->url_img ? Storage::url(auth()->user()->url_img) : asset('img/avatars/user.png') }}" class="rounded-circle img-responsive mt-2"
                                                width="128" height="128" />
                                           {{--  <div class="mt-2">
                                                <span class="btn btn-primary"><i class="fas fa-upload"></i> Upload</span>
                                            </div> --}}
                                            
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>

                        </div>
                    </div>


                </div>
                <div class="tab-pane fade show active" id="password" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="alert-message">
                                    {{ session('success') }}
                                </div>
                            </div>
                                
                            @endif
                            <h5 class="card-title">Password</h5>
                           
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
<script>
    $(document).ready(function() {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        $('#avatar-form').on('submit', function(e) {
            e.preventDefault(); // Mencegah form submit biasa
    
            var formData = new FormData(this); // Menyiapkan data form
    
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false, // Jangan mengubah data menjadi string
                contentType: false, // Jangan set contentType, karena formData sudah menangani itu
                success: function(response) {
                    // Menampilkan avatar baru
                    // $('#avatar-image').attr('src', response.avatar_url);
                    alert('Avatar berhasil diubah!');
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan saat mengupload avatar.');
                }
            });
        });
    });
    </script>
@endsection

