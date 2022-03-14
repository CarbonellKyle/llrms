@extends($layout, $data) 
<!-- $layout is the layout file to extend, $data contains variables to be pass at the layout file from the controller -->

@section('content')
<div id="content" class="content-wrapper p-3">
    <!-- If user is student button is hidden -->
    <button @if(auth()->user()->group_id==3) hidden @endif id="sidebarCollapse" type="button" class="btn bg-color-3 rounded-pill shadow-sm px-4 mb-4">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
        </svg>
    </button>
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
        <div class="col-lg-6">
            <form class="col-md-12" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h5 class="title m-0">{{ __('Edit Profile') }}</h5>
                    </div>
                    <div class="card-body">
                        
                        <!-- Username Input Start -->
                        <div class="form-floating">
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="{{ auth()->user()->username }}" required>
                            <label for="username">{{ __('Username') }}</label>
                        </div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                        <!-- Username Input End -->

                        <!-- Email Input Start -->
                        <div class="form-floating my-2">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ auth()->user()->email }}" required @if(auth()->user()->google_id!=null) disabled @endif>
                            <label for="email">{{ __('Email') }}</label>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <!-- Email Input End -->

                        <!-- First Name Input Start -->
                        <div class="form-floating">
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Firstname" value="{{ auth()->user()->first_name }}" required>
                            <label for="first_name">{{ __('First Name') }}</label>
                        </div>
                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                        <!-- First Name Input End -->
                    
                        <!-- Last Name Input Start -->
                        <div class="form-floating my-2">
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Lastname" value="{{ auth()->user()->last_name }}" required>
                            <label for="last_name">{{ __('Last Name') }}</label>
                        </div>
                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                        <!-- Last Name Input End -->
                        
                        <!-- Office Select Start -->
                        <div class="form-floating">
                            <select name="office_id" id="office_id" class="form-select" required>
                                <option value="{{ $user_office->office_id }}" selected="selected" hidden>{{ $user_office->officename }}</option>
                                @foreach( $offices as $office )
                                    <option value="{{ $office->id }}">{{ $office->officename }}</option>
                                @endforeach
                            </select>
                            <label for="office_id">Office</label>
                        </div>
                        @if ($errors->has('office_id'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('office_id') }}</strong>
                            </span>
                        @endif
                        <!-- Office Select End -->

                        <!-- Position Select Start -->
                        <div class="form-floating mt-2">
                            <select name="position_id" id="position_id" class="form-select" required>
                                <option value="{{ $user_position->position_id }}" selected="selected" hidden>{{ $user_position->name }}</option>
                                @foreach( $positions as $position )
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>
                                @endforeach
                            </select>
                            <label for="position_id">Position</label>
                        </div>
                        @if ($errors->has('position_id'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('position_id') }}</strong>
                            </span>
                        @endif
                        <!-- Position Select End -->
                    </div>
                    <div class="card-footer ">
                        <button type="submit" class="btn btn-primary btn-lg w-100 btn-round">{{ __('Save Changes') }}</button>   
                    </div>
                </div>
            </form>
        </div>

        <div class="col-lg-6">
            <form action="{{ route('profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h5 class="title m-0">{{ __('Change Password') }}</h5>
                    </div>
                    <div class="card-body">
                        <!-- Old Password Input Start -->
                        <div class="form-floating">
                            <input type="password" name="old_password" id="old_password" class="form-control" placeholder="Old password" required>
                            <label for="old_password">{{ __('Old Password') }}</label>
                        </div>
                        @if ($errors->has('old_password'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('old_password') }}</strong>
                            </span>
                        @endif
                        <!-- Old Password Input End -->

                        <!-- New Password Input Start -->
                        <div class="form-floating my-2">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <label for="password">{{ __('New Password') }}</label>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <!-- New Password Input End -->
                        
                        <div class="form-floating">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Password Confirmation" required>
                            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" style="display: block;" role="alert">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="card-footer ">
                        <button type="submit" class="btn btn-primary btn-lg w-100 btn-round">{{ __('Save Changes') }}</button>   
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection