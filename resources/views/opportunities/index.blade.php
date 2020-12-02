@extends('layouts.app')

@section('content')

{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-2">--}}

{{--            </div>--}}
            @include('layouts.left-pane')

            <div class="col-sm-8 m-auto ">
                    @if(Session::has('msg'))
                        <div class="alert alert-info">
                            <p>{{ Session::get("msg") }}  </p>
                        </div>
                    @endif
                <div class="top-display">Opportunities</div>
                @forelse($opportunities as $opportunity)
                    <div class=" panel mb-3">
                        <div class="">
                            @can('view', $opportunity)
                                <p class="font-weight-bold">You</p>
                            @endcan
                            @cannot('view', $opportunity)
                                @if($opportunity->user->employerprofile)
{{--                                    <p class="font-weight-bold">{{ $opportunity->user->employerprofile['first_name'] }} {{ $opportunity->user->employerprofile['last_name'] }} </p>--}}
                                    <p class="font-weight-bold">{{ getFullName($opportunity->user->id) }} </p>
                                    <p class="small">{{ $opportunity->user->employerprofile['position'] }}, {{ strtoupper( $opportunity->user->employerprofile['institution_name']) }}</p>
                                @endif
                            @endcannot
                        </div>
                        <div class="">
                            <p class="font-weight-bold"><a href="/opportunities/{{ $opportunity->id }}">{{ $opportunity->title }}</a></p>
                            <div>
                                @if(strlen($opportunity->description) > 100)
                                    {!!  substr($opportunity->description,0,100) !!} ...
{{--                                    <span class="read-more-show hide_content">More<i class="fa fa-angle-down"></i></span>--}}
{{--                                    <span class="read-more-content"> {!! substr($opportunity->description,100,strlen($opportunity->description)) !!}--}}
{{--                                <span class="read-more-hide hide_content">Less <i class="fa fa-angle-up"></i></span>--}}
                                @else
                                    {!! $opportunity->description !!}
                                @endif
                            </div>
                            <div>
                                @forelse($opportunity->tags as $tag)
                                    <span class="badge badge-info">{{ $tag->name  }}</span>
                                @empty

                                @endforelse
                            </div>

{{--                            <p class="">{{ $opportunity->description }}</p>--}}
{{--                                <p class="">{{ $opportunity->take_app }}</p>--}}
                            @if($opportunity->open !== null && $opportunity->close !== null)
                            <div class="row align-text-bottom mt-2">
                                <div class="col-sm-6 small font-weight-bold">Opened: {{ date("D, d M Y", strtotime($opportunity->open)) }}</div>
                                <div class="col-sm-6 small font-weight-bold">Closes: {{ date("D, d M Y", strtotime($opportunity->close)) }}</div>
                            </div>
                                @endif

                            <save-component status="{{ \Illuminate\Support\Facades\DB::table('saved_opening')->where('opportunity_id', $opportunity->id)->where('user_id', auth()->user()->id)->where('status', "saved")->count() }}" opportunity="{{ $opportunity->id }}"></save-component>
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
{{--            <div class="col-sm-2">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

@endsection

@section('read_more')
    <script type="text/javascript" src="{{ asset('js/read-more.js') }}"></script>
@endsection
