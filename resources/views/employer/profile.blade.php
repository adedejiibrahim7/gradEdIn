@extends('layouts.app')

@section('content')
    <div>
        <div class="row">
            <div class="col-sm-8 m-auto">
                <div class="panel panel-large ">
{{--                    <div class="display-3">Hellow</div>--}}
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="m-auto text-right">
                                <img src="/{{ $profile->avatar }}" alt="Profile Image" class="avatar">
                            </div>
                        </div>

                        <div class="col-sm-8 pl-3 text-left">
                            <div class="">
                                <p class="top-display text-left">{{ $profile->title }} {{ $profile->first_name }} {{ $profile->last_name }}</p>
                            </div>
                            <div>
                                <p>{{ $profile->position }}, <a href="{{ $profile->website }}">{{ strtoupper($profile->institution_name) }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
