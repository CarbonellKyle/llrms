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

            <div class="d-flex">
                <!-- First Name Input Start -->
                <input id="first_name" type="text" class="me-1 form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required autocomplete="first_name" autofocus>
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- First Name Input End -->
                
                <!-- Last Name Input Start -->
                <input id="last_name" type="text" class="ms-1 form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required autocomplete="last_name" autofocus>
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <!-- Last Name Input End -->
            </div>
			

            <!-- Group Select Start -->
            <select name="group_id" class="my-2 py-2 form-select" required>
                <option value="none" selected disabled hidden>Select Group</option>
                @foreach( $groups as $group )
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('group_id'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('group_id') }}</strong>
                </span>
            @endif
            <!-- Group Select End -->

            <!-- Office Select Start -->
            <select name="office_id" class="form-select" required>
                <option value="none" selected disabled hidden>Select Office</option>
                @foreach( $offices as $office )
                    <option value="{{ $office->id }}">{{ $office->officename }}</option>
                @endforeach
            </select>
            @if ($errors->has('office_id'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('office_id') }}</strong>
                </span>
            @endif
            <!-- Office Select End -->

            <!-- Position Select Start -->
            <select name="position_id" class="my-2 py-2 form-select" required>
                <option value="none" selected disabled hidden>Select Position</option>
                @foreach( $positions as $position )
                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('position_id'))
                <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('position_id') }}</strong>
                </span>
            @endif
            <!-- Position Select End -->

            <!-- Hidden since already filled during initial registration -->
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required autocomplete="email">

            <!-- Password Input Start -->
            <input id="password" type="password" class="my-2 py-2 form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
			<!-- Password Input End -->

            <!-- Confirm Password Input Start -->
            <input id="password-confirm" type="password" class="my-2 py-2 form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
            <!-- Confirm Password Input End -->

			<button type="submit" class="btn btn-lg bg-color-1 text-white w-100">Submit</button>

		</form>
	</section>
</div>

@endsection
