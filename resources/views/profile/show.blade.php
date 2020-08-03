@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-8 m-auto ">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="text-right">
{{--                            <img src="/storage/{{ $profile->avatar }}" alt="media" class="img-fluid">--}}
                            <img src="/storage/uploads/profile/image/cSKfGPIOAwVlUtS6PkJd9a0WAQ7xM8AetsV1TvUD.jpeg" alt="avatar" class="avatar">
                        </div>

                    </div>

                    <div class="col-sm-8 p-20">
                        <div>
                            <p class="top-display text-left">{{ $profile->first_name }}, {{ strtoupper($profile->last_name) }}  </p>
                            @can('update', $profile)
                                <p><a href="/profile/edit/{{ $profile->id }}"><button class="btn btn-primary">Edit Profile</button></a></p>
                            @endcan
                            @forelse($profile->certifications as $certification)
                                <span class="fa fa-check p-2 font-weight-bold" style="color:green">{{ $certification->certification }}</span>
                                @empty
{{--                                <span class="fa fa-check"></span>--}}
                            @endforelse
                        </div>
                        <div>
                            <p class="">{{ $profile->bio }}</p>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p><a href="/storage/{{ $profile->cv }}" target="_blank"><span class="fa fa-link"></span> CV</a></p>
                            </div>
                            <div class="col-sm-6">
                                <p><a href="/storage/{{ $profile->cover_letter }}" target="_blank"><span class="fa fa-link"></span> Cover Letter</a></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="row ml-5">
                    <div class="col-sm-6">
                        <p class="font-weight-bold">Academic History</p>
{{--                        <hr>--}}
                    @forelse($academic_history as $ach)
                            <p>{{ $ach->school }}</p>
                            <p>{{ $ach->course }}</p>
                            <p>{{ $ach->certification }}</p>
                            <div class="small">{{ $ach->start }} - {{ $ach->end }}</div>
                        @empty
                            None
                        @endforelse
                    </div>
                    <div class="col-sm-6">
                        <p class="font-weight-bold">Skills and Competencies</p>
                        @forelse($skills as $skill)
                            <p>{{ $skill->skill }}</p>
                        @empty

                        @endforelse
                    </div>
                </div>
                <div class="row ml-5">
{{--                    <div class="col-sm-6">--}}
{{--                        <p class="font-weight-bold mt-3">Skills and Competencies</p>--}}
{{--                    @forelse($skills as $skill)--}}
{{--                            <p>{{ $skill->skill }}</p>--}}
{{--                            @empty--}}

{{--                        @endforelse--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>

@endsection
