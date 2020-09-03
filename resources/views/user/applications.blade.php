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
{{--                        <div class="col-sm-4">--}}
{{--                            <img src="/{{ $application->opportunity->media }}" alt="media" class=" card-img">--}}
{{--                        </div>--}}
                        <div class="">
                            <p class="font-weight-bold"><a href="/opportunities/{{ $application->opportunity->id }}">{{ $application->opportunity->title }}</a></p>
                            @if(strlen($application->opportunity->description) > 100)
                                {!!  substr($application->opportunity->description,0,100) !!}
                                <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                                <span class="read-more-content"> {!! substr($application->opportunity->description,100,strlen($application->opportunity->description)) !!}
                                <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span>
                            @else
                                {{$application->opportunity->description}}
                            @endif
                        </div>
                    </div>
                    @empty
                        None found
                    @endforelse

            </div>
        </div>
    </div>

@endsection

@section('read_more')
    <script type="text/javascript" src="{{ asset('js/read-more.js') }}"></script>
@endsection
