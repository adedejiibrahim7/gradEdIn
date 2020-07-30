@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        @if(Session::has('msg'))
            <div class="alert alert-info">
                <p>{{ Session::get("msg") }}  </p>
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-md-2">
            <p class=""><a href="#">My Opportunities</a></p>
            <p class=""><a href="/opportunities/create">Post Opportunity</a></p>
            <p class=""><a href="/my-applications">My Applications</a></p>
            <p><a href="/profile/{{ auth()->user()->profile->id }}">My Profile</a></p>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
