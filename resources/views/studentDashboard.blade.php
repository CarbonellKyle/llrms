@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Student Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Welcome, <strong>{{ Auth::user()->username }}</strong>! You are Logged in as a <strong>Student</strong>!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection