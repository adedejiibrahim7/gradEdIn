@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-2">
{{--                <p class=""><a href="/my-opportunities">My Opportunities</a></p>--}}
{{--                <p class=""><a href="/opportunities/create">Post Opportunity</a></p>--}}
{{--                <p class=""><a href="/my-applications">My Applications</a></p>--}}
{{--                <p><a href="/profile/{{ auth()->user()->id }}">My Profile</a></p>--}}
            </div>
            <div class="col-sm-8 m-auto p-20">
                    @if(Session::has('msg'))
                        <div class="alert alert-info">
                            <p>{{ Session::get("msg") }}  </p>
                        </div>
                    @endif
                <div class="top-display">Opportunities</div>
                @forelse($opportunities as $opportunity)
                    <div class=" panel mb-3">
                        <div class="">

                            @if($opportunity->user->employerprofile)
                                <p class="font-weight-bold">{{ $opportunity->user->employerprofile['first_name'] }} {{ $opportunity->user->employerprofile['last_name'] }} </p>
                                <p class="small">{{ $opportunity->user->employerprofile['position'] }}, {{ strtoupper( $opportunity->user->employerprofile['institution_name']) }}</p>
                            @endif

                        </div>
                        <div class="">
                            <p class="font-weight-bold"><a href="/opportunities/{{ $opportunity->id }}">{{ $opportunity->title }}</a></p>
                            @if(strlen($opportunity->description) > 100)
                                {{substr($opportunity->description,0,100)}}
                                <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>
                                <span class="read-more-content"> {{substr($opportunity->description,100,strlen($opportunity->description))}}
                                <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span> </span>
                            @else
                                {{$opportunity->description}}
                            @endif
                            <div>
                                @forelse($opportunity->tags as $tag)
                                    <span class="badge badge-info">{{ $tag->name  }}</span>
                                @empty

                                @endforelse
                            </div>

{{--                            <p class="">{{ $opportunity->description }}</p>--}}
{{--                                <p class="">{{ $opportunity->take_app }}</p>--}}
                            <div class="row align-text-bottom mt-2">
                                <div class="col-sm-6 small font-weight-bold">Opened: {{ date("D, d M Y", strtotime($opportunity->open)) }}</div>
                                <div class="col-sm-6 small font-weight-bold">Closes: {{ date("D, d M Y", strtotime($opportunity->close)) }}</div>
                            </div>
                        </div>
                    </div>
                    @empty
                        None found
                    @endforelse

                <div>
                    <ul class="pagination">
                        {{ $opportunities->links() }}
                    </ul>
                </div>
            </div>
            <div class="col-sm-2">
{{--                <div class="display-4">Hello</div>--}}
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
