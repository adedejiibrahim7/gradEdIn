@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-8 m-auto ">
                <div class=" panel ">
                    <p>{{ $opportunity->user_id }}</p>
                    <div class="img-p-l m-auto">
                        <img src="/storage/{{ $opportunity->media }}" alt="media" class="img-fluid">
                    </div>
                    <div class="text-center pt-3">
                        <div>
                            <p class="font-weight-bold">{{ $opportunity->title }}</p>
                        </div>
                        <div>
                            <p class="">{{ $opportunity->description }}</p>
                        </div>
                        <div class="row align-text-bottom">
                            <div class="col-sm-6">{{ $opportunity->open }}</div>
                            <div class="col-sm-6">{{ $opportunity->close }}</div>
                        </div>
                        <div>
                            @if($opportunity->take_app)
{{--                                <div class="row">--}}
{{--                                <p>Apply Here</p>--}}
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
                                        <button type="submit" class="btn btn-primary ">Apply Now</button>
                                    </div>
                                </form>
                                @else
                                <div class="form-group text-center">
                                    <a href="{{ $opportunity->link }}" target="_blank"><button type="submit" class="btn btn-primary btn-lg"><span class="fa fa-external-link"></span>Apply</button></a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
