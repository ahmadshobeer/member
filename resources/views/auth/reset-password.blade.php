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
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">No HP</label>
                                    <input class="form-control form-control-lg" type="text" name="no_hp" placeholder="Masukkan nomer HP" />
                                </div>
                                <div class="d-grid gap-2 mt-3">
                                    <a class='btn btn-lg btn-primary' href='/'>Reset password</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="text-center mb-3">
                    Don't have an account? <a href='/pages-sign-up'>Sign up</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection