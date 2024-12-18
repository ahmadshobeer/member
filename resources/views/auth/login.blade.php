@extends('layouts.auth')
@section('content')

<div class="container d-flex flex-column">
	<div class="row vh-100">
		<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
			<div class="d-table-cell align-middle">

				<div class="text-center mt-4">
					<h1 class="h2">Welcome back!</h1>
					<p class="lead">
						Sign in to your account to continue
					</p>
				</div>

				<div class="card">
					<div class="card-body">
						<div class="m-sm-3">
							{{-- <div class="alert alert-primary alert-dismissible" role="alert">
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								<div class="alert-message">
									<strong>Hello there!</strong> A simple primary alert—check it out!
								</div>
							</div> --}}
							<form id="loginForm" method="POST" action="{{ route('login.post') }}" class="needs-validation" novalidate="">
								@csrf
								<div id="errors-list"></div>
								
								<div class="mb-3">
									<label class="form-label">Email</label>
									<input class="form-control form-control-lg" type="text" name="phone" placeholder="Enter your Phone" id="phone" required/>
									<div class="invalid-feedback">
										Please fill in your username
									</div> 
									@if ($errors->has('phone'))
										<span class="text-danger">{{ $errors->first('phone') }}</span>
									@endif
								</div>
								<div class="mb-3">
									<label class="form-label">Password</label>
									<input class="form-control form-control-lg" type="password" name="password" placeholder="Enter your password" id="password" required/>
									<div class="invalid-feedback">
										please fill in your password
									</div> 
									@if ($errors->has('password'))
										<span class="text-danger">{{ $errors->first('password') }}</span>
									@endif
								</div>
								<div>
									<div class="form-check align-items-center">
										<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
										<label class="form-check-label text-small" for="customControlInline">Remember me</label>
									</div>
								</div>
								<div class="d-grid gap-2 mt-3">
									<button type="submit"  class="btn btn-lg btn-primary">Login</button>
									
								</div>
								
							</form>
						</div>
						<div id="result" style="margin-top: 20px;"></div>
						@if (session('status'))
						<div class="alert alert-success" role="alert">
							<div class="alert-message">
								<span>{{session('status')}}</span>
							</div>
							
						</div>
					@endif
					</div>
				</div>
				<div class="text-center mb-3">
					Lupa Password ? <a href="/forgot-password">Klik Disini</a>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$(document).on("submit", "#loginForm", function() {
			var e = this;
	
			$(this).find("[type='submit']").html("Login...");
	
			$.ajax({
				url: $(this).attr('action'),
				data: $(this).serialize(),
				type: "POST",
				dataType: 'json',
				success: function (data) {
					console.log(data);
	
					$(e).find("[type='submit']").html("Login");
	
					if (data.status) {
						window.location = data.redirect;
					}else{
						$(".alert").remove();
						$.each(data.errors, function (key, val) {
							$("#errors-list").append("<div class='alert alert-danger alert-dismissible' role='alert'><div class='alert-message'>"+val+"</div>");
						});
					}
				
				}
			});
	
			return false;
		});
	})
</script>
	
@endsection