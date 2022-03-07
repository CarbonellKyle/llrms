@extends('layouts.app')

@section('content')

<div class="content-wrapper">
	<section id="form-wrapper" class="shadow-lg px-4 bg-white">
		<div class="text-center">
			<a href="#"><img src="{{ asset('images/lrmds-logo.png') }}" class="logo img-fluid" alt="LRDMS Logo"></a>
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
			
			<button type="submit" class="btn btn-lg bg-color-1 text-white w-100">Sign In</button>
			<div class="or py-2">
				<hr>
				<p class="text-uppercase text-center bg-white px-3">or</p>
			</div>
			<a href="{{ url('/redirect') }}"><img src="{{ asset('images/google-signin.png') }}" class="img-fluid" alt="LRDMS Logo"></a>
			<p class="mt-2 text-center">Don't have an account? <a href="signup.php" class="text-decoration-none text-primary">Sign Up Now!</a></p>
		</form>
	</section>
</div>

@endsection
