@extends('layouts.app')

@section('content')

<div class="site-grad">
    <div class="site-grid">
        <section id="form-wrapper" class="shadow-lg px-4 bg-white">
            <div class="text-center">
                <h1 class="mb-3">{{ __('Register') }}</h1>
            </div>
            <form method="GET" action="{{ route('chooseUserType') }}">
                @csrf

                <!-- Username Input Start -->
                <div class="form-floating">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" required autocomplete="username" autofocus>
                    <label for="username">Username</label>
                </div>
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- Username Input SEnd -->
                
                <!-- Email Input Start -->
                <div class="form-floating my-2">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">
                    <label for="email">Email</label>
                </div>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- Email Input End -->
                
                <button type="submit" class="btn btn-lg bg-color-1 text-white w-100">Register</button>
                <div class="or py-2">
                    <hr>
                    <p class="text-uppercase text-center bg-white px-3">or</p>
                </div>
                <a href="{{ url('/redirect') }}"><img src="{{ asset('images/google-signup.png') }}" class="img-fluid" alt="Google Sign In"></a>
                <!--<p class="mt-2 text-center">Already had an account? <a href="{{ url('/login') }}" class="text-decoration-none text-primary">Sign In Now!</a></p>-->
            </form>
        </section>
    </div>
</div>

@endsection
