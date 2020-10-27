<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>GradEdIn</title>

    <!-- Fonts -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
<body>

    <div>
    <div class="content">

        <div class="row">
            <div class="col"></div>
            <div class="col-sm-6">
                <div class="panel p-5">
                    <form action="/admin/update/{{ $user->id }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group align-content-center m-auto">
                            <p style="height:150px; width: 150px; font-size: 100px; color: gray; background-color: aliceblue; border-radius:50%;" class="text-center m-auto">
                                <span class="fa fa-user text-center" id="profile_photo"></span>
                            </p>
                            <input type="file" id="avatar" name="avatar"  style="display:none" accept="image/jpeg image/jpg image/png"/>
                            <div class="text-center">
                                <div class="mt-1">
{{--                                    <p class="error" id="avatarRes"></p>--}}
                                    <label for="avatar" class="m-auto btn btn-outline-info">Choose Profile Photo</label>
                                </div>
                                @error('avatar')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="text" class="btn btn-outline-dark btn-sm"  disabled value="{{ $user->email }}">
                            <input type="hidden" class="btn btn-outline-dark btn-sm" name="email" id="email"  value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name">

                            @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" name="password" class="form-control" id="password">

                            @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">

                            @error('password_confirmation')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/04d124077d.js" crossorigin="anonymous"></script>

</body>
</html>
