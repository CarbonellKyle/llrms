@extends('layouts.app')

@section('content')

<div class="site-grad">
    <div class="site-grid">
        @auth()
        <section id="form-wrapper" class="shadow-lg px-4 bg-white">
            <div class="text-center">
                <h2 class="mb-3">{{ __('Who will use this account?') }}</h2>
            </div>

            <form method="GET" action="{{ route('continueRegister') }}">
                @csrf

                <!-- Pass google_id if user have chosen to sign in with google -->
                @if(isset($google_id))
                    <input type="hidden" name="google_id" value="{{ $google_id }}" />
                @endif

                <!-- Hidden since already filled during initial registration -->
                <input id="username" type="hidden" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $username }}" required autocomplete="username" autofocus>

                <!-- Group Select Start -->
                <div class="form-floating my-2">
                    <div class="col-12 d-flex">
                        <div class="col-4" @if((auth()->user()->id)!=1) hidden @endif>
                            <input type="radio" id="personnel" name="group_id" value="1">
                            <label for="personnel">Personnel</label>
                        </div>
                        <div class="col-4" @if((auth()->user()->group_id)>1) hidden @endif >
                            <input type="radio" id="teacher" name="group_id" value="2" class="ml-4">
                            <label for="teacher">Teacher</label>
                        </div>
                        <div class="col-4">
                            <input type="radio" id="student" name="group_id" value="3" class="ml-4">
                            <label for="student">Student</label>
                        </div>
                    </div>
                </div>
                @if ($errors->has('group_id'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('group_id') }}</strong>
                    </span>
                @endif
                <!-- Group Select End -->

                <!-- Hidden since already filled during initial registration -->
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required hidden autocomplete="email">

                <button type="submit" class="btn btn-lg bg-color-1 text-white w-100">Next</button>

            </form>
        </section>
        @endauth

        @guest()
            <div class="text-center">
                <img src="{{ asset('images/oops.jpg') }}" style="width: 400px; height: auto;" />
                <h1 class="mt-2">Your gmail is not registered on this site!<h1>
                <h3 style="margin-top: -10px;">Please ask your Superior/Teacher to create an acount for you</h3>
            </div>
        @endguest
    </div>
</div>

@endsection
