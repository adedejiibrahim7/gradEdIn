@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <p class="display-4 text-center">Let's setup your profile..</p>
{{--        <div class="col-md-2"></div>--}}
        <div class="col-md-8">
            <div class="panel panel-large">
                <form action="">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <select name="title" id="title" class="form-control select2 @error('title') is-invalid @enderror">
                                    <option>Title</option>
                                    <option value="Dr">Dr</option>
                                    <option value="Prof">Prof</option>
                                </select>
                                @error('title')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror" value="{{ old('firstName') }}">

                                @error('firstName')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" value="{{ old('lastName') }}">

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
                                <textarea rows="10" cols="100" id="bio" style="resize: none" class="form-control @error('bio') is-invalid @enderror" name="bio" value="{{ old('bio') }}" required  autofocus></textarea>
                                @error('bio')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
{{--                        <div class="col-sm-1"></div>--}}
                    </div>
                    <div class="row text-center">
                        <div class="col-sm-4">
                            <p class="font-weight-bold">Academic History</p>
                            <hr>
                            <div class="text-left">
                                <div class="form-group text-left">
                                    <label for="school">School</label>
{{--                                    <input type="text" class="form-control form-control-small  @error('school') is-invalid @enderror" name="school " id="school">--}}
                                    <select type="text" class="form-control form-control-small select2-default  @error('school') is-invalid @enderror" name="school " id="school">
                                    @error('school')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <input type="text" class="form-control form-control-small @error('course') is-invalid @enderror" name="course " id="course">
                                    @error('course')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="certification">Certification</label>
                                    <input type="text" class="form-control form-control-small @error('certification') is-invalid @enderror" name="certification " id="certification">
                                    @error('certification')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-4 text-left">
                            <p class="font-weight-bold">Certifications & Exams</p>
                            <hr>
                            <div class="form-group">

                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="gre" name="gre">
                                <label class="form-check-label" for="gre">GRE</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="ielts" name="ielts">
                                <label class="form-check-label" for="ielts">IELTS</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="toefl" name="toefl">
                                <label class="form-check-label" for="toefl">TOEFL</label>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-light btn-sm">Other</button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <p class="font-weight-bold">Skills & Competencies</p>
                            <hr>
                            <div class="form-group">
                                <select name="skills[]" id="skills" class="select2 select2-multiple" multiple="multiple" data-placeholder="Select Skills">
                                    <option value="#">Data Analysis</option>
                                    <option value="#">Research</option>
                                    <option value="#">Machine Learning (Python)</option>
                                </select>
                                @error('skills')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
{{--        <div class="col--md-2"></div>--}}
    </div>
</div>

@endsection
