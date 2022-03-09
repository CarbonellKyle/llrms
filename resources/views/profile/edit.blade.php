<<<<<<< HEAD
@extends('layouts.personnelLayout')
=======
@extends('layouts.personnelLayout', ['position' => $user_position->name])
>>>>>>> f88ce007430e91fbbe2c79dfda3c4e69b37fc94e

@section('content')
    <div class="content">

        @if(Session::has('status'))
            <div class="alert alert-success text-left alert-dismissible fade show">
                <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                    aria-label="Close">
                    <i class="nc-icon nc-simple-remove"></i>
                </button>
                <span>
                    {{Session::get('status')}}
                </span>
            </div>
        @endif

        @if(Session::has('password_status'))
            <div class="alert alert-success text-left alert-dismissible fade show">
                <button type="button" aria-hidden="true" class="close" data-dismiss="alert"
                    aria-label="Close">
                    <i class="nc-icon nc-simple-remove"></i>
                </button>
                <span>
                    {{Session::get('password_status')}}
                </span>
            </div>
        @endif

        <div class="row">
            <div class="col-md-4">
    
            </div>
            <div class="col-md-8 text-center">
                <form class="col-md-12" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Edit Profile') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Username') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control" placeholder="Name" value="{{ auth()->user()->username }}" required>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Email') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ auth()->user()->email }}" required @if(auth()->user()->google_id!=null) disabled @endif>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Firstname') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="first_name" class="form-control" placeholder="Firstname" value="{{ auth()->user()->first_name }}" required>
                                    </div>
                                    @if ($errors->has('first_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Lastname') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" name="last_name" class="form-control" placeholder="Lastname" value="{{ auth()->user()->last_name }}" required>
                                    </div>
                                    @if ($errors->has('last_name'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!-- Office Select Start -->
                            <select name="office_id" class="form-select" required>
                                <option value="{{ $user_office->office_id }}" selected="selected" hidden>{{ $user_office->officename }}</option>
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
                                <option value="{{ $user_position->position_id }}" selected="selected" hidden>{{ $user_position->name }}</option>
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
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form class="col-md-12 mt-5" action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('Change Password') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Old Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="old_password" class="form-control" placeholder="Old password" required>
                                    </div>
                                    @if ($errors->has('old_password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('New Password') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-md-3 col-form-label">{{ __('Password Confirmation') }}</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-info btn-round">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection