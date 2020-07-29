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
{{--                <div class="display-4">Hello</div>--}}
                @forelse($profiles as $profile)
                    <div class="row panel mb-3">
                        <div class="col-sm-4">
                            <img src="/storage/{{ $profile->avatar }}" alt="media" class=" card-img">
                        </div>
                        <div class="col-sm-8">
                            <p class="font-weight-bold"><a href="/opportunities/{{ $profile->id }}">{{ $profile->first_name }}, {{ strtoupper($profile->last_name)  }}</a></p>
                            <p class="">{{ $profile->bio }}</p>
                            <div class="row align-text-bottom">
                                <div class="col-sm-6">
                                    @if($profile->application[0]->resume != "document")
                                        <a href="/storage/{{ $profile->application[0]->resume }}">Resume</a>
                                    @else
                                        <a href="/storage/{{ $profile->cv }}">CV</a>
                                    @endif
                                </div>
                                <div class="col-sm-6">
                                    @if($profile->application[0]->cover_letter != "document")
                                        <a href="/storage/{{ $profile->application[0]->cover_letter }}">Cover Letter</a>
                                    @else
                                        <a href="/storage/{{ $profile->cover_letter }}">Cover Letter (General)</a>
                                    @endif
                                </div>
                                {{--                                <div class="col-sm-6">{{ $profile->open }}</div>--}}
                                {{--                                <div class="col-sm-6">{{ $profile->close }}</div>--}}
                            </div>
                        </div>
                    </div>
                    @empty
                        None found
                    @endforelse

            </div>
        </div>
    </div>

@endsection
