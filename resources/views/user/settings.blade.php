@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-2">

            </div>
            <div class="col-sm-8">
                <div class="card pl-5 pr-5 pt-3 pb-5">
                    @if($user_type == "recruiter")
                        <p class="font-weight-bold">Switch to Seeker</p>
                        <form action="/switch" method="post">
                            @csrf
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="switch" name="switch">
                                <label class="custom-control-label" for="switch">Seeker</label>
                            </div>
                            <div class="form-group mt-2 text-right">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                            <hr>
                        </form>
                    @elseif($user_type == "seeker")
                        <p class="font-weight-bold">Switch to Employer</p>
                        <form action="/switch" method="post">
                            @csrf
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="switch" name="switch">
                                <label class="custom-control-label" for="switch">Employer</label>

                            </div>
                            <div class="form-group mt-2 text-right">
                                <button type="submit" class="btn btn-info">Save</button>
                            </div>
                            <hr>
                        </form>
                    @endif
                </div>
            </div>
            <div class="col-sm-2">

            </div>
        </div>
    </div>

@endsection
