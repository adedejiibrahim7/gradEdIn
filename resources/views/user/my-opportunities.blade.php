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
                <div class="top-display">Opportunities Posted</div>
                @forelse($opportunities as $opportunity)
                    <div class="row panel mb-3">
{{--                        <div class="col-sm-4">--}}
{{--                            <img src="/{{ $opportunity->media }}" alt="media" class=" card-img">--}}
{{--                        </div>--}}
                        <div class="col">
                            <div>
{{--                                <div style="" class="" >--}}
{{--                                    <img src="{{ auth()->user()->EmployerProfile->avatar }}" alt="" class="avatar-small" style="">--}}
{{--                                </div>--}}
                                <p class="font-weight-bold">You</p>
                            </div>
                            <p class="font-weight-bold"><a href="/applications/{{ $opportunity->id }}">{{ $opportunity->title }}</a></p>
{{--                            <p class="">{{ $opportunity->description }}</p>--}}
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
