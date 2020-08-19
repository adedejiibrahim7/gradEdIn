@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row p-20">
            <div class="col-sm-2">
                <p class=""><a href="/my-opportunities">Openings Posted</a></p>
                <p class=""><a href="/opportunities/create">Post Opportunity</a></p>
                <p class=""><a href="/my-applications">My Applications</a></p>
                <p><a href="/profile/{{ auth()->user()->id }}">My Profile</a></p>
            </div>
            <div class="col-sm-8 m-auto ">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">25</h5>
                                    <p class="card-text font-weight-bold">Openings Posted Posted</p>
{{--                                    <a class="card-link">Card link</a>--}}
{{--                                    <a class="card-link">Another link</a>--}}
                                </div>
                            </div>
                        </div>

{{--                        <div class="col">--}}
{{--                            <div class="card">--}}
{{--                                <div class="card-body">--}}
{{--                                    <h5 class="card-title">108</h5>--}}
{{--                                    <p class="card-text font-weight-bold">Applications Received</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">13</h5>
                                    <p class="card-text font-weight-bold">Active Openings</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">123</h5>
                                    <p class="card-text font-weight-bold">Applications Received</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <div>
                    @forelse($applicants as $applicant)
                        <div class="row panel mb-3">
                            <div class="col-sm-4">
                                <img src="/{{ $applicant->avatar }}" alt="media" class=" card-img">
                            </div>
                            <div class="col-sm-8">
                                <p class="font-weight-bold"><a href="/profile/{{ $applicant->id }}">{{ $applicant->first_name }}, {{ strtoupper($applicant->last_name)  }}</a></p>
                                @if(strlen($applicant->bio) > 150)
                                    {{substr($applicant->bio,0,150)}}
                                    <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                                    <span class="read-more-content"> {{substr($applicant->bio,150,strlen($applicant->bio))}}
                                <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                                @else
                                    {{$applicant->bio}}
                                @endif

                                <div class="row align-text-bottom">
                                    <div class="col-sm-6">
                                        @if($applicant->application[0]->resume != "document")
                                            <a href="/storage/{{ $applicant->application[0]->resume }}">Resume</a>
                                        @else
                                            <a href="/storage/{{ $applicant->cv }}">CV</a>
                                        @endif
                                    </div>
                                    <div class="col-sm-6">
                                        @if($applicant->application[0]->cover_letter != "document")
                                            <a href="/storage/{{ $applicant->application[0]->cover_letter }}">Cover Letter</a>
                                        @else
                                            <a href="/storage/{{ $applicant->cover_letter }}">Cover Letter (General)</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="text-center m-5">
                            <p class="top-display">You Have No Recent Applications</p>
                            <p>Applications are coming, check back some other time</p>
                        </div>
                </div>
                    @endforelse
            </div>
            <div class="col-sm-2 text-center">
{{--                <div class="display-4">Hello</div>--}}
                <div class="text-center">
                    <button class="btn  btn-info">Post an Opening</button>
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
