@extends('layouts.app')

@section('content')

<div class="site-grad">
    <div class="site-grid">
        <section id="form-wrapper" class="shadow-lg px-4 bg-white">
            <div class="text-center">
                <h1 class="mb-3">{{ __('Complete Registration') }}</h1>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Pass google_id if user have chosen to sign in with google -->
                @if(isset($google_id))
                    <input type="hidden" name="google_id" value="{{ $google_id }}" />
                @endif

                <!-- Hidden since already filled during initial registration -->
                <input id="username" type="hidden" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $username }}" required autocomplete="username" autofocus>

                <div class="d-flex mb-2">
                    <!-- First Name Input Start -->
                    <div class="form-floating me-1">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required autocomplete="first_name" autofocus>
                        <label for="first_name">First Name</label>
                    </div>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!-- First Name Input End -->
                    
                    <!-- Last Name Input Start -->
                    <div class="form-floating ms-1">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required autocomplete="last_name" autofocus>
                        <label for="last_name">Last Name</label>
                    </div>
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <!-- Last Name Input End -->
                </div>
                
                <!-- Group id is hidden since already filled during choose user type -->
                <input type="hidden" name="group_id" value="{{ $group_id }}">

                <!-- Office Select Start -->
                <div class="form-floating mb-2">
                    <select id="office_id" name="office_id" class="form-select" required>
                        <!-- Change the word 'Office' into 'School' if usertype is Student -->
                        <option value="none" selected disabled hidden>{{ $group_id!=3 ? 'Select Office' : 'Select School'}}</option>
                        @foreach( $offices as $office )
                            <option value="{{ $office->id }}">{{ $office->officename }}</option>
                        @endforeach
                    </select>
                    <!-- Change the word 'Office' into 'School' if usertype is Student -->
                    <label for="office_id">{{ $group_id!=3 ? 'Office' : 'School' }}</label>
                </div>
                @if ($errors->has('office_id'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('office_id') }}</strong>
                    </span>
                @endif
                <!-- Office Select End -->

                <!-- Position Select Start -->
                <div class="form-floating mb-2">
                    <select id="position_id" name="position_id" class="form-select" required>
                        <!-- Change the word 'Position' into 'Grade Level' if usertype is Student -->
                        <option value="none" selected disabled hidden>{{ $group_id!=3 ? 'Select Position' : 'Select Grade Level'}}</option>
                        @foreach( $positions as $position )
                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                        @endforeach
                    </select>
                    <!-- Change the word 'Position' into 'Grade Level' if usertype is Student -->
                    <label for="position_id">{{ $group_id!=3 ? 'Position' : 'Grade Level'}}</label>
                </div>
                @if ($errors->has('position_id'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                        <strong>{{ $errors->first('position_id') }}</strong>
                    </span>
                @endif
                <!-- Position Select End -->

                <!-- Hidden since already filled during initial registration -->
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required hidden autocomplete="email">

                <!-- Password Input Start -->
                <div class="form-floating">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                    <label for="password">Password</label>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- Password Input End -->

                <!-- Confirm Password Input Start -->
                <div class="form-floating my-2">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                    <label for="password-confirm">Confirm Password</label>
                </div>
               
                <!-- Confirm Password Input End -->

                <button type="submit" class="btn btn-lg bg-color-1 text-white w-100">Submit</button>

            </form>
        </section>
    </div>
</div>

@endsection
