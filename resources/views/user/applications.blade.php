@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-8 m-auto ">
                    @if(Session::has('msg'))
                        <div class="alert alert-info">
                            <p>{{ Session::get("msg") }}  </p>
                        </div>
                    @endif
                <div class="top-display">My Applications</div>
                @forelse($applications as $application)
                    <div class="row panel mb-3">
                        <div class="col-sm-4">
                            <img src="/{{ $application->opportunity->media }}" alt="media" class=" card-img">
                        </div>
                        <div class="col-sm-8">
                            <p class="font-weight-bold"><a href="/opportunities/{{ $application->opportunity->id }}">{{ $application->opportunity->title }}</a></p>
                            <p class="">{{ $application->opportunity->description }}</p>
{{--                            <div class="row align-text-bottom">--}}
{{--                                <div class="col-sm-6">{{ $profile->open }}</div>--}}
{{--                                <div class="col-sm-6">{{ $profile->close }}</div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    @empty
                        None found
                    @endforelse

            </div>
        </div>
    </div>

@endsection
