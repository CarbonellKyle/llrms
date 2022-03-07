@extends('layouts.app')

@section('content')

<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background-image:linear-gradient(#50b748, #3256A7);
    }
</style>
<div class="content-wrapper">
	<section id="form-wrapper" class="shadow-lg px-4 bg-white">
		<div class="text-center">
			<a href="#"><img src="{{ asset('images/lrmds-logo.png') }}" class="logo img-fluid" alt="LRDMS Logo"></a>
		</div>
		<form method="GET" action="{{ route('continueRegister') }}">
            @csrf

			<!-- Username Input Start -->
            <input id="username" type="text" class="my-2 py-2 form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" required autocomplete="username" autofocus>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!-- Username Input SEnd -->
			
            <!-- Email Input Start -->
            <input id="email" type="email" class="my-2 py-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!-- Email Input End -->
			
			<button type="submit" class="btn btn-lg bg-color-1 text-white w-100">Sign Up</button>
			<div class="or py-2">
				<hr>
				<p class="text-uppercase text-center bg-white px-3">or</p>
			</div>
			<a href="{{ url('/redirect') }}"><img src="{{ asset('images/google-signup.png') }}" class="img-fluid" alt="Google Sign In"></a>
			<p class="mt-2 text-center">Already had an account? <a href="{{ url('/login') }}" class="text-decoration-none text-primary">Sign In Now!</a></p>
		</form>
	</section>
</div>

@endsection
