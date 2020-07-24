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
                <div class="display-4">Hello</div>
                @forelse($opportunities as $opportunity)
                    <div class="row panel mb-3">
                        <div class="col-sm-4">
                            <img src="/storage/{{ $opportunity->media }}" alt="media" class=" card-img">
                        </div>
                        <div class="col-sm-8">
                            <p class="font-weight-bold"><a href="/opportunities/{{ $opportunity->id }}">{{ $opportunity->title }}</a></p>
                            <p class="">{{ $opportunity->description }}</p>
{{--                                <p class="">{{ $opportunity->take_app }}</p>--}}
                            <div class="row align-text-bottom">
                                <div class="col-sm-6">{{ $opportunity->open }}</div>
                                <div class="col-sm-6">{{ $opportunity->close }}</div>
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
