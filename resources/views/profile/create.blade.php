@extends('layouts.app')

@section('content')
<div class="container">
    <p class="top-display">Profile Setup</p>
    <div id="result">

    </div>
    <div class="row justify-content-center">
{{--        <div class="col-md-2"></div>--}}
        <div class="col-md-8">
            <div class="panel panel-large">

                <form action="/p" method="post" enctype="multipart/form-data" id="profile_setup">
                    @csrf
                    <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
                    <div class="form-group align-content-center m-auto">
                            <p style="height:150px; width: 150px; font-size: 100px; color: gray; background-color: aliceblue; border-radius:50%;" class="text-center m-auto">
                                <span class="fa fa-user text-center"  id="profile_photo"></span>
                            </p>
                            <input type="file" id="avatar" name="avatar"  style="display:none" accept="image/jpeg image/jpg image/png"/>
                            <div class="text-center">
                                <div>
                                    <p class="error" id="avatarRes"></p>
                                    <label for="avatar" class="m-auto">Upload Profile Photo</label>
                                </div>
                                @error('avatar')
                                    <div class="text-danger">
                                         {{ $message }}
                                    </div>
                                @enderror
                            </div>
                    </div>
                    <div class="row m-3">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 ">
                            <div class="input-group mb-3 m-auto">
                                <div class="input-group-prepend">
                                    <label for="title"  class="input-group-text">Title</label>
                                </div>
                                <select name="title" id="title" class="custom-select @error('title') is-invalid @enderror">
                                    <option>Select</option>
                                    <option value="Dr">Dr</option>
                                    <option value="Prof">Prof</option>
                                </select>
                                <p class="error" id="titleRes"></p>

                                @error('title')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    <div class="row ml-3 mr-3">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror" value="{{ old('firstName') }}">
                                <p class="error" id="firstNameRes"></p>

                                @error('firstName')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" value="{{ old('lastName') }}">
                                <p class="error" id="lastNameRes"></p>

                                @error('firstName')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>

                            </div>
                    </div>
                    <div class="row">
{{--                        <div class="col-sm-1"></div>--}}
                        <div class="col-sm-12">
                            <div class="form-group @error('bio') has-error @enderror p-20">
                                <label for="bio">Bio</label>
                                <p class="error" id="bioRes"></p>

                                <textarea rows="10" cols="100" id="bio" style="resize: none" class="form-control @error('bio') is-invalid @enderror" name="bio"  required >{{ old('bio') }}</textarea>
                                @error('bio')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
{{--                        <div class="col-sm-1"></div>--}}
                    </div>
                    <div class="mt-1 ml-5 mr-5">
                        <div class="">
                            <p class="font-weight-bold">Academic History</p>
                            <p class="error" id="achRes"></p>

                            <hr>
                                <div class="row">
                                <div class="col-sm-8">
                                    <div class="text-left academic_history" id="root">
                                        <div class="form-group">
                                            <label for="school">University</label>
                                            <input type="text" class="form-control  @error('school') is-invalid @enderror ach" name="school[]" id="school" value="">
                                            @error('school')
                                            <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="course">Program</label>
                                            <input type="text" class="form-control ach @error('course') is-invalid @enderror" name="course[]" id="course" value="">
                                            @error('course')
                                            <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <label for="certification" class="input-group-text">Degree</label>
                                            </div>
                                            <select type="text" class="custom-select ach @error('certification') is-invalid @enderror" name="certification[]" id="certification">
                                                <option>Select</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="B.A">Bachelor of Arts</option>
                                                <option value="BSc">Bachelor of Science</option>
                                                <option value="BFA">Bachelor of Fine Arts</option>
                                                <option value="BAS">Bachelor of Applied Science</option>
                                                <option value="MSc">Master of Science</option>
                                                <option value="M.A">Master of Arts</option>
                                                <option value="PhD">Doctor of Philosophy</option>
                                            </select>
                                            @error('certification')
                                            <span>{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label for="start">Start</label>
                                                <input type="date" name="start[]" id="start" class="form-control ach @error('start') is-invalid @enderror" value="">
                                                @error('start')
                                                <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="end">End</label>
                                                <input type="date" name="end[]" id="end" class="form-control ach @error('end') is-invalid @enderror" value="">
                                                @error('end')
                                                <span>{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row text-center">
                                            <div class="col-sm-6">
{{--                                                <button class="btn btn-danger btn-sm remove_button">Remove</button>--}}
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="javascript:void(0);" class="btn btn-info btn-sm add_button">Add Fields</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-sm-4"></div>

                            </div>
                        </div>
                        <div class=" mt-4 mb-4">
                            <p class="font-weight-bold ">Certifications & Exams</p>
                            <hr>
                            <div class="row">
                                <div class=" col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="gre" name="gre">
                                        <label class="custom-control-label" for="gre">GRE</label>
                                    </div>
                                    <div class="input-group input-group-sm mb-2 mt-2 pr-4 score" id="gre_block">
                                        <input type="text" class="form-control" id="gre_score" name="gre_score">
                                        <div class="input-group-append">
                                            <span class="input-group-text" >/340</span>
                                        </div>
                                    </div>
                                    <p class="error" id="greRes"></p>

                                </div>
                                <div class=" col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="ielts" name="ielts">
                                        <label class="custom-control-label" for="ielts">IELTS</label>
                                    </div>
                                    <div class="input-group input-group-sm mb-2 mt-2 pr-4 score" id="ielts_block">
                                        <input type="text" class="form-control " id="ielts_score" name="ielts_score">
                                        <div class="input-group-append">
                                            <span class="input-group-text" >/9</span>
                                        </div>
                                    </div>
                                    <p class="error" id="ieltsRes"></p>

                                </div>
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="toefl" name="toefl">
                                        <label class="custom-control-label" for="toefl">TOEFL</label>
                                    </div>
                                    <div class="input-group input-group-sm mb-2 mt-2 pr-4 score" id="toefl_block">
                                        <input type="text" class="form-control " name="toefl_score" id="teofl_score">
                                        <div class="input-group-append">
                                            <span class="input-group-text" >/120</span>
                                        </div>
                                    </div>
                                    <p class="error" id="toeflRes"></p>

                                </div>
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="gmat" name="gmat">
                                        <label class="custom-control-label" for="gmat">GMAT</label>
                                    </div>
                                    <div class="score input-group input-group-sm mb-2 mt-2 pr-4" id="gmat_block">
                                        <input type="text" class="form-control " name="gmat_score" id="gmat_score">
                                        <div class="input-group-append">
                                            <span class="input-group-text" >/800</span>
                                        </div>
                                    </div>
                                    <p class="error" id="gmatRes"></p>

                                </div>
                            </div>


                        </div>
                        <div class="mb-4">
                            <p class="font-weight-bold">Skills & Competencies</p>
                            <hr>
{{--                            <div class="input-group text-left">--}}
                                <input type="text" name="skills[]" id="skills" class="form-control" data-role="tagsinput" class="" placeholder="Skills">
{{--                                <select name="skills[]" id="skills" data-role="tagsinput"  multiple>--}}

{{--                                    @forelse(App\skills::all() as $skill)--}}
{{--                                        <option value="{{ $skill->id }}">{{ $skill->skill }}</option>--}}
{{--                                    @empty--}}
{{--                                        No skills added to database--}}
{{--                                    @endforelse--}}
{{--                                </select>--}}
                                @error('skills')
                                    <span>{{ $message }}</span>
                                @enderror
{{--                            </div>--}}
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cv">CV</label>
                                <input type="file" name="cv" id="cv" class="form-control-file" accept=".pdf, .doc, .docx">
                                <p class="error" id="cvRes"></p>

                                @error('cv')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="cover_letter">Cover Letter</label>
                                <input type="file" name="cover_letter" id="cover_letter" class="form-control-file" accept=".pdf, .doc, .docx" >
                                <p class="error" id="cover_letterRes"></p>

                                @error('cover_letter')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <div class="form-group text-center mt-5">
                        <button type="submit" class="btn btn-primary btn-lg" id="go">Go</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('add_form')

    <script src="{{ asset('js/fields.js') }}" defer></script>

@endsection
