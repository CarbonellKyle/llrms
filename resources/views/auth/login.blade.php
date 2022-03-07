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
			<h1 class="mb-3">{{ __('Login') }}</h1>
		</div>
		<form method="POST" action="{{ route('login') }}">
            @csrf

			<!-- Email Input Start -->
            <input id="email" type="email" class="my-2 py-2 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!-- Email Input SEnd -->
			
            <!-- Password Input Start -->
            <input id="password" type="password" class="my-2 py-2 form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <!-- Password Input End -->
			
			<button type="submit" class="btn btn-lg bg-color-1 text-white w-100">Login</button>
			<div class="or py-2">
				<hr>
				<p class="text-uppercase text-center bg-white px-3">or</p>
			</div>
			<a href="{{ url('/redirect') }}"><img src="{{ asset('images/google-signin.png') }}" class="img-fluid" alt="Google Sign In"></a>
			<p class="mt-2 text-center">Don't have an account? <a href="{{ url('/register') }}" class="text-decoration-none text-primary">Sign Up Now!</a></p>
		</form>
	</section>
</div>

@endsection
