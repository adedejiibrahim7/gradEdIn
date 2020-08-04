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
