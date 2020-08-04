@extends('layouts.app')

@section('content')
<div class="container">
    <p class="top-display">Profile Setup</p>
    <div class="row justify-content-center">
{{--        <div class="col-md-2"></div>--}}
        <div class="col-md-8">
            <div class="panel panel-large">

                <form action="/p" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="">
                            <label for="avatar">Avatar</label>
{{--                            <input type="file" name="avatar" id="avatar" class=" dropify" data-allowed-file-extensions="jpg png jpeg">--}}
                            <input type="file" name="avatar" id="avatar" class="form-control-file" >
                            @error('avatar')
                            <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
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
                            <div class="text-left academic_history" id="root">
                                <div class="form-group ">
                                    <label for="school">School</label>
                                    <input type="text" class="form-control form-control-small  @error('school') is-invalid @enderror" name="school" id="school">
                                    {{--                                    <select type="text" class="form-control form-control-small select2-default  @error('school') is-invalid @enderror" name="school " id="school"></select>--}}
                                    @error('school')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="course">Course</label>
                                    <input type="text" class="form-control form-control-small @error('course') is-invalid @enderror" name="course" id="course">
                                    @error('course')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="certification">Certification</label>
                                    {{--                                    <input type="text" class="form-control form-control-small @error('certification') is-invalid @enderror" name="certification " id="certification">--}}
                                    <select type="text" class="form-control form-control-small select2 @error('certification') is-invalid @enderror" name="certification" id="certification">
                                        <option>Select</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="B.A">Bachelor of Arts</option>
                                        <option value="BSc">Bachelor of Science</option>
                                        <option value="BFA">Bachelor of Fine Arts</option>
                                        <option value="BAS">Bachelor of Applied Science</option>
                                        <option value="MSc">Master of Science</option>
                                        <option value="M.A">Master of Arts</option>
                                        <option value="PhD">Doctor of Philosophy</option>
                                        {{--                                        <option value=""></option>--}}
                                        {{--                                        <option value=""></option>--}}
                                    </select>
                                    @error('certification')
                                    <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label for="start">Start</label>
                                        <input type="date" name="start" id="start" class="form-control form-control-small @error('start') is-invalid @enderror">
                                        @error('start')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="end">End</label>
                                        <input type="date" name="end" id="end" class="form-control form-control-small @error('end') is-invalid @enderror">
                                        @error('end')
                                        <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row text-center">
                                    <div class="col-sm-6">
                                        <button class="btn btn-danger btn-sm remove_button">x</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="javascript:void(0);" class="btn btn-success btn-sm add_button">+</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-sm-4 text-left">
                            <p class="font-weight-bold text-center">Certifications & Exams</p>
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
{{--                                    <option value="1">Data Analysis</option>--}}
{{--                                    <option value="2">Research</option>--}}
{{--                                    <option value="3">Machine Learning (Python)</option>--}}
                                    @forelse($skills as $skill)
                                        <option value="{{ $skill->id }}">{{ $skill->skill }}</option>
                                    @empty
                                        No skills added to database
                                    @endforelse
                                </select>
                                @error('skills')
                                    <span>{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="cv">CV</label>
                            <input type="file" name="cv" id="cv" class="dropify" data-allowed-file-extensions="pdf doc docx">
                            @error('cv')
                                 <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label for="cover_letter">Cover Letter</label>
                            <input type="file" name="cover_letter" id="cover_letter" class="dropify" data-allowed-file-extensions="png jpeg jpg">
                            @error('cover_letter')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group text-center mt-5">
                        <button type="submit" class="btn btn-primary btn-lg">Go</button>
                    </div>
                </form>
            </div>
        </div>
{{--        <div class="col--md-2"></div>--}}
    </div>
</div>

@endsection
@section('add_form')

        <script type="text/javascript">
            $(document).ready(function(){
                var maxField = 10; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.academic_history'); //Input field wrapper
                var fieldHTML = document.getElementById('root').cloneNode(true); //New input field html
                // var fieldHTML = document.getElementById('root').innerHTML(); //New input field html
                fieldHTML.id = '';
                fieldHTML.class = 'text-left';
                var x = 1; //Initial field counter is 1

                //Once add button is clicked
                $(addButton).click(function(){
                    // alert("l");

                    // e.preventDefault();
                    // alert('j');
                    //Check maximum number of input fields
                    // if(x < maxField){
                        // x++; //Increment field counter
                        $(wrapper).append(fieldHTML); //Add field html
                        // $(wrapper).parentNode.insertBefore(fieldHTML); //Add field html
                    // }
                });

                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });
            });
        </script>
    @endsection
