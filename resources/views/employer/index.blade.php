@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row p-20">
            <div class="col-sm-2">
{{--                <p class=""><a href="/my-opportunities">Openings Posted</a></p>--}}
{{--                <p class=""><a href="/opportunities/create">Post Opportunity</a></p>--}}
{{--                <p class=""><a href="/my-applications">My Applications</a></p>--}}
{{--                <p><a href="/profile/{{ auth()->user()->id }}">My Profile</a></p>--}}
            </div>

            <div class="col-sm-8">
                <div class="row mb-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">25</h5>
                                <p class="card-text font-weight-bold">Openings Posted</p>
                            </div>
                        </div>
                    </div>

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
                        @foreach($profiles as $profile)
                            <div class="p-3">
                                <div class="panel">
                                    <div class="row  mb-3">
                                        <div class="col-sm-4">
                                            <img src="/{{ $profile->avatar }}" alt="media" class=" card-img">
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="font-weight-bold"><a href="/profile/{{ $profile->id }}">{{ $profile->first_name }}, {{ strtoupper($profile->last_name)  }}</a></p>
                                            @if(strlen($profile->bio) > 150)
                                                {{substr($profile->bio,0,150)}}
                                                <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                                                <span class="read-more-content"> {{substr($profile->bio,150,strlen($profile->bio))}}
                                <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                                            @else
                                                {{$profile->bio}}
                                            @endif

                                            <div class="row align-text-bottom">
                                                <div class="col-sm-6">
                                                    @if($applicant->resume != "document")
                                                        <a href="{{ $applicant->resume }}">Resume</a>
                                                    @else
                                                        <a href="{{ $applicant->cv }}">CV</a>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    @if($applicant->cover_letter != "document")
                                                        <a href="{{ $applicant->cover_letter }}">Cover Letter</a>
                                                    @else
                                                        <a href="{{ $applicant->cover_letter }}">Cover Letter (General)</a>
                                                    @endif
                                                </div>
                                            </div>
                                            <star-component status="{{ $applicant->status }}" application="{{ $applicant->id }}"></star-component>
                                            <div class="text-right" style="">
                                                <p class="card-title" >Application for: <span class="font-weight-bold">{{ $applicant->opportunity->title }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        @endforeach
                    @empty
                        <div class="text-center m-5">
                            <p class="top-display">You Have No Recent Applications</p>
                            <p>If you have an active job opening, applications are coming. Check back some other time</p>
                        </div>
                    @endforelse
                </div>
            </div>


            <div class="col-sm-2 text-center">
{{--                <div class="display-4">Hello</div>--}}
                <div class="text-center">
                    <a href="/opportunities/create">
                        <button class="btn  btn-info">Post an Opening</button>
                    </a>
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
