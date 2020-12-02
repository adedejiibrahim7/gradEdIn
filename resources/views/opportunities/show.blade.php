@extends('layouts.app')

@section('content')

    @include('layouts.left-pane')

    <div class="col-sm-8 m-auto ">
        <div class=" panel ">
            @can('view', $opportunity)
                <p class="font-weight-bold">You</p>
            @endcan

            @cannot('view', $opportunity)
                <p class="font-weight-bold">{{ $opportunity->user->employerprofile->first_name }} {{ $opportunity->user->employerprofile->last_name }}</p>
                <p class="small" >{{ $opportunity->user->employerprofile->position }}, <a href="{{ $opportunity->user->employerprofile->institution_website }}">{{ $opportunity->user->employerprofile->institution_name }}</a> </p>
            @endcannot
            <div class=" pt-3">
                <div>
                    <p class="font-weight-bold">{{ $opportunity->title }}</p>
                </div>
                <div class="text-left">
                    <p class="">{!! $opportunity->description !!}</p>
                </div>
                <div class="row align-text-bottom">
                    <div class="col-sm-6">Open: {{ date("D, d M Y", strtotime($opportunity->open)) }}</div>
                    <div class="col-sm-6">Closes: {{ date("D, d M Y", strtotime($opportunity->close)) }}</div>
                </div>
                <div class="p-2">

                    @forelse($tags as $tag)

                            <span class="badge badge-info">{{ $tag->name  }}</span>

                        @empty

                        @endforelse
                </div>
                <div>
                    @if(!auth()->user()->is_admin)
                        @cannot('view', $opportunity)
                        @if($opportunity->take_app)
                            @if(count($applied) == 0)
                                <form action="/apply/{{ $opportunity->id }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-sm-6 form-group text-left">
                                            <label for="resume">Resume (Optional)</label>
                                            <input type="file" name="resume" id="resume" class="form-control-file @error('resume') is-invalid @enderror">
                                            @error('resume')
                                                <span>{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6 form-group text-left">
                                            <label for="cover_letter">Cover Letter (Optional)</label>
                                            <input type="file" name="cover_letter" id="cover_letter" class="form-control-file @error('cover_letter') is-invalid @enderror">
                                            @error('cover_letter')
                                                <span>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary ">Apply</button>
                                    </div>
                                </form>
                            @else
                                <p class="text-center font-weight-bold mt-2">You already applied</p>
                            @endif

                        @else
                            <div class="form-group text-center">
                                <a href="{{ $opportunity->link }}" target="_blank"><button type="submit" class="btn btn-primary btn-lg"><span class="fa fa-external-link"></span>Apply</button></a>
                            </div>
                        @endif
                    @endcannot
                        @else
                        <div class="text-center mt-2">
                            @if($opportunity->status == "pending")
                                <a href="/approve/{{ $opportunity->id }}">
                                    <button class="btn btn-info">Approve</button>
                                </a>
                                @elseif($opportunity->status == "active")
                                <a href="/close/{{ $opportunity->id }}">
                                    <button class="btn btn-danger">Close Opening</button>
                                </a>
                                @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
