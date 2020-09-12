@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-8 m-auto panel">
                <div class="row ">
                    <div class="col-sm-4">
                        <div class="m-auto text-right">
{{--                            <img src="/storage/{{ $profile->avatar }}" alt="media" class="img-fluid">--}}
                            <img src="/{{ $profile->avatar }}" alt="Profile Image" class="avatar">
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
                            @endforelse
                        </div>

                    </div>

                    <div class=" pt-3 text-center" style="padding-left: 80px; padding-right: 80px;">
                        <p class="">{{ $profile->bio }}</p>

                        <div class="row">
                            <div class="col-sm-6">
                                <p><a href="/{{ $profile->cv }}" target="_blank"><span class="fa fa-link"></span> CV</a></p>
                            </div>
                            <div class="col-sm-6">
                                <p><a href="/{{ $profile->cover_letter }}" target="_blank"><span class="fa fa-link"></span> Cover Letter</a></p>
                            </div>
                        </div>
                    </div>

                    <hr>
                </div>
                <div class="row ml-5">
                    <div class="col-sm-6 mt-1">
                        <p class="font-weight-bold">Academic History</p>
                        <hr>
                        @forelse($academic_history as $ach)
                            <p class="fwlb"><span>{{ $ach->certification }} {{ $ach->course }}, </span>{{ $ach->school }}</p>
                            <p class="small">{{ date("M Y", strtotime($ach->start)) }} - {{ date("M Y", strtotime($ach->end)) }}</p>
                        @empty
                            None
                        @endforelse
                    </div>
{{--                    <div class="col-sm-6">--}}
{{--                        <p class="font-weight-bold">Skills and Competencies</p>--}}
{{--                        @forelse($skills as $skill)--}}
{{--                            <p>{{ $skill->name }}</p>--}}
{{--                        @empty--}}

{{--                        @endforelse--}}
{{--                    </div>--}}
                </div>
                <div class="row ml-5">
                    <div class="col-sm-6">
                        <p class="font-weight-bold mt-3">Skills and Competencies</p>
                        <hr>
                    @forelse($skills as $skill)
                            <span class="label-info">{{ $skill->name }}</span>
                            @empty
                            None
                        @endforelse
                    </div>
                </div>

                <div class="row ml-5">
                    <div class="col-sm-6">
                        <p class="font-weight-bold mt-2">Publications</p>
                        <hr>

                        @forelse($profile->user->publication as $pub)
                            <p class="fwlb"><a href="{{ $pub->link }}" target="_blank">{{ $pub->title }}</a></p>
                            @empty
                        <p>None Added</p>
                            @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
