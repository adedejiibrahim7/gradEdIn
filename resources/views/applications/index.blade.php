@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8 m-auto ">
                    @if(Session::has('msg'))
                        <div class="alert alert-info">
                            <p>{{ Session::get("msg") }}  </p>
                        </div>
                    @endif
                <div class="top-display">Applications Received for <span style="color: #070775  ">{{ strtoupper($opportunity->title) }} </span> </div>
                        <div class="text-center">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#all">All</a></li>
                                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#starred">Starred</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div id="all" class="tab-pane fade-in active">
                                @forelse($applications as $application)
{{--                                    @foreach($profiles as $profile)--}}
                                        <div class="row panel mb-3 mt-1">
                                            <div class="col-sm-4">
                                                <img src="/{{ $application->profile->avatar }}" alt="media" class=" card-img">
                                            </div>
                                            <div class="col-sm-8">
                                                <p class="font-weight-bold"><a href="/profile/{{ $application->profile->id }}">{{ $application->profile->first_name }}, {{ strtoupper($application->profile->last_name)  }}</a></p>
                                                @if(strlen($application->profile->bio) > 150)
                                                    {{substr($application->profile->bio,0,150)}}
                                                    <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                                                    <span class="read-more-content"> {{substr($application->profile->bio,150,strlen($application->profile->bio))}}
                                                    <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                                                @else
                                                    {{$application->profile->bio}}
                                                @endif

                                                <div class="row align-text-bottom">
                                                    <div class="col-sm-6">
                                                        @if($application->resume != "")
                                                            <a href="/storage/{{ $application->resume }}">Resume</a>
                                                        @else
                                                            <a href="/storage/{{ $application->profile->cv }}">CV</a>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-6">
                                                        @if($application->cover_letter != "")
                                                            <a href="/storage/{{ $application->cover_letter }}">Cover Letter</a>
                                                        @else
                                                            <a href="/storage/{{ $application->profile->cover_letter }}">Cover Letter (General)</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <star-component status="{{ $application->status }}" application="{{ $application->id }}"></star-component>
                                            </div>
                                        </div>

{{--                                    @endforeach--}}
                                @empty
                                    <div class="text-center">
                                        <p>
                                            You have no applications for this opening yet
                                        </p>
                                    </div>
                                @endforelse
                                    <div class="text-center">
                                        <ul class="pagination">
                                            {{ $applications->links() }}
                                        </ul>
                                    </div>

                            </div>
                            <div id="starred" class="tab-pane fade">
                                @forelse($starred_ as $starred)
                                    <div class="row panel mb-3 mt-1">
                                        <div class="col-sm-4">
                                            <img src="{{ $starred->profile->avatar }}" alt="media" class=" card-img">
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="font-weight-bold"><a href="/profile/{{ $starred->profile->id }}">{{ $starred->profile->first_name }}, {{ strtoupper($starred->profile->last_name)  }}</a></p>
                                            @if(strlen($starred->profile->bio) > 150)
                                                {{substr($starred->profile->bio,0,150)}}
                                                <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                                                <span class="read-more-content"> {{substr($starred->profile->bio,150,strlen($starred->profile->bio))}}
                                                <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                                            @else
                                                {{$starred->profile->bio}}
                                            @endif

                                            <div class="row align-text-bottom">
                                                <div class="col-sm-6">
                                                    @if($starred->resume != "")
                                                        <a href="{{ $starred->resume }}">Resume</a>
                                                    @else
                                                        <a href="{{ $starred->profile->cv }}">CV</a>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    @if($starred->cover_letter != "")
                                                        <a href="{{ $starred->cover_letter }}">Cover Letter</a>
                                                    @else
                                                        <a href="{{ $starred->profile->cover_letter }}">Cover Letter (General)</a>
                                                    @endif
                                                </div>

                                            </div>
                                            <star-component status="{{ $starred->status }}" application="{{ $starred->id }}"></star-component>

                                        </div>
                                    </div>

                                @empty
                                    <div class="text-center">
                                        You have no starred application for this opening
                                    </div>
                                @endforelse

                                    <div class="text-center">
                                        <ul class="pagination">
                                            {{ $starred_->links() }}
                                        </ul>
                                    </div>
                            </div>
                        </div>


            </div>
            <div class="col-sm-2">
                <div>
                    <a href="/applications/get-csv/{{ $opportunity->id }}">
                        <button class="btn btn-info">Download CSV <span class="fa fa-download"></span></button>
                    </a>
                    <p class="small">A .csv (spreadsheet) file of name, email address of applicant</p>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('read_more')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.read-more-content').addClass('hide_content')
            $('.read-more-show, .read-more-hide').removeClass('hide_content')

            // Set up the toggle effect:
            $('.read-more-show').on('click', function(e) {
                $(this).next('.read-more-content').removeClass('hide_content');
                $(this).addClass('hide_content');
                e.preventDefault();
            });

            // Changes contributed by @diego-rzg
            $('.read-more-hide').on('click', function(e) {
                var p = $(this).parent('.read-more-content');
                p.addClass('hide_content');
                p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
                e.preventDefault();
            });
        });

    </script>
@endsection
