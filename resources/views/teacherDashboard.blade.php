@extends('layouts.teacherLayout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Teacher Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Welcome, <strong>{{ Auth::user()->username }}</strong>! You are Logged in as a <strong>Teacher</strong>!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection