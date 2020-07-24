@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-8 m-auto ">
                <div class=" panel ">
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
                            <a href="/apply/{{ $opportunity->id }}"><button class="btn btn-primary btn-lg">Apply Now</button></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
