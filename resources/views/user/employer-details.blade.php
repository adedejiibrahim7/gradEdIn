@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
{{--        <div class="col-md-2"></div>--}}
        <div class="col-md-8">
            <p class="top-display">Profile Setup</p>

            <div class="panel panel-large ">

                <form action="/ep" method="post" enctype="multipart/form-data">
                    @csrf
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
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" name="firstName" class="form-control @error('firstName') is-invalid @enderror" value="{{ old('firstName') }}">

                                @error('firstName')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" value="{{ old('lastName') }}">

                                @error('lastName')
                                <span>{{ $message }}</span>
                                @enderror
                            </div>

                            </div>
                    </div>


                    <div class="p-20">
                        <div class="form-group">
                            <label for="institution">Institution Name</label>
                            <input type="text" name="institution" class="form-control @error('institution') is-invalid @enderror" value="{{ old('institution') }}">

                            @error('institution')
                            <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="position">Current Position/Job Title</label>
                            <input type="text" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position') }}">

                            @error('position')
                            <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="website">Institution's Website</label>
                            <input type="text" name="website" class="form-control @error('website') is-invalid @enderror" value="{{ old('website') }}">

                            @error('website')
                            <span>{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Personal/Office Phone</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">

                            @error('phone')
                            <span>{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group text-center mt-2">
                        <button type="submit" class="btn btn-primary btn-lg">Go</button>
                    </div>
                </form>
            </div>
        </div>
{{--        <div class="col--md-2"></div>--}}
    </div>
</div>

@endsection

@section('oneScript')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#profile_photo').click(function(){
                $('#avatar').click()
            });
        })
    </script>
    @endsection

