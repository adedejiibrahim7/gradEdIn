@extends('layouts.app')

@section('content')
<div class="container">
    <p class="top-display">Edit Profile</p>
    <div class="row justify-content-center">
{{--        <div class="col-md-2"></div>--}}
        <div class="col-md-8">
            <div class="">
                    <div class="panel panel-large ">
                        <div class="row">
                            <div class="col-sm-8">
                                <form action="" id="pf">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col text-center mt-1">
                                                <img src="/{{ $profile->avatar }}" alt="Profile Image" class="avatar">
                                                <input type="file" value="" id="avatar" name="avatar" hidden>
                                                <button class="btn btn-sm btn-info pf mt-2 pf" id="p-change" disabled>Change</button>
                                            </div>
                                            <div class="col">

                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="bio">Bio</label>
                                        <textarea type="text" name="bio" class="form-control pf" rows="7" value="Lorem ipsum dolor" maxlength="250" id="bio"  disabled>{{ $profile->bio }}</textarea>
                                        <div class="text-right" style="color: gray;" id="char_count"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="col text-right">
                                <div class="icon ml-auto mr-3" id="pf-e">
                                    <span class="fas fa-pen" ></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel panel-large mt-1">
                        <div class="font-weight-bold">
                            <p>Personal Details</p>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <form action="" id="personal-details">

                                    @csrf
                                    @method('patch')
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <select type="text" class="form-control pde" name="title" id="title" disabled>
                                            <option value="{{ $profile->title }}">{{ $profile->title }}</option>
                                            <option value="Mr">Mr</option>
                                            <option value="Miss">Miss</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Engnr">Engnr</option>
                                            <option value="Dr">Dr</option>
                                            <option value="Prof">Prof</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" class="form-control pde" name="first_name" id="first_name" value="{{ $profile->first_name }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" class="form-control pde" id="last_name" name="last_name" value="{{ $profile->last_name }}" disabled>
                                    </div>

                                </form>

                            </div>

                            <div class="col text-right">
                                <div class="icon ml-auto mr-3" id="pd-e">
                                    <span class="fas fa-pen" ></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-large mt-1">
                        <div class="font-weight-bold">
                            <p>Academic History</p>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <form action="" id="academic_history">
                                    @csrf
                                    @method('PATCH')
                                    @forelse($profile->academic_history as $ach)
                                        <div class="form-group">
                                            <label for="school">University</label>
                                            <input type="text" class="form-control ach" id="school" name="school" value="{{$ach->school}}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="course">Program</label>

                                            <input type="text" class="form-control ach" name="course" id="course" value="{{ $ach->course }}" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="certification">Degree</label>
                                            {{--                                    <input type="text" class="form-control ach" value="Lorem ipsum dolor" disabled>--}}
                                            <select class="form-control ach" name="certification" id="certification" disabled>
                                                <option value="{{ $ach->certification }}">{{ $ach->certification }}</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="B.A">Bachelor of Arts</option>
                                                <option value="BSc">Bachelor of Science</option>
                                                <option value="BFA">Bachelor of Fine Arts</option>
                                                <option value="BAS">Bachelor of Applied Science</option>
                                                <option value="MSc">Master of Science</option>
                                                <option value="M.A">Master of Arts</option>
                                                <option value="PhD">Doctor of Philosophy</option>
                                            </select>
                                        </div>
                                        <hr>
                                    @empty

                                    @endforelse
                                </form>


                            </div>

                            <div class="col text-right">
                                <div class="icon ml-auto mr-3" id="ach-e">
                                    <span class="fas fa-pen"></span>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="icon ml-auto" id="add">
                                +
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <form action="" id="ach_new_form">
                                        <div id="ach_new">

                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-4">

                                </div>
                            </div>
                            <hr>

                        </div>
                    </div>

            </div>
        </div>
{{--        <div class="col--md-2"></div>--}}
    </div>
</div>

@endsection
@section('add_form')

        <script type="text/javascript" src="{{ asset('js/edit.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/char_limit.js') }}"></script>
    @endsection
