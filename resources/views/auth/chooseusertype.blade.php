@extends('layouts.app')

@section('content')

<div class="site-grad">
    <div class="site-grid">
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
                    <select id="group_id" name="group_id" class="form-select" required>
                        <option value="none" selected disabled hidden>Select Usertype</option>
                        @foreach( $groups as $group )
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                    <label for="group_id">Group</label>
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
    </div>
</div>

@endsection
