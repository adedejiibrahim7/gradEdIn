<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GradEdIn</title>

    <!-- Fonts -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
{{--    @if (Route::has('login'))--}}
{{--        <div class="top-right links">--}}
{{--            @auth--}}
{{--                <a href="{{ url('/home') }}">Home</a>--}}
{{--            @else--}}
{{--                <a href="{{ route('login') }}">Login</a>--}}

{{--                @if (Route::has('register'))--}}
{{--                    <a href="{{ route('register') }}">Signup</a>--}}
{{--                @endif--}}
{{--            @endauth--}}
{{--        </div>--}}
{{--    @endif--}}

    <div class="content">
        <div class="top-display">Find Opportunities</div>
        <div class="title">
            GradEdIn
        </div>

        <div>
            <div class="panel">
                <form action="/admin/update/{{ $user->id }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group align-content-center m-auto">
                        <p style="height:150px; width: 150px; font-size: 100px; color: gray; background-color: aliceblue; border-radius:50%;" class="text-center m-auto">
                            <span class="fa fa-user text-center" id="profile_photo"></span>
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

                    <div class="form-group">
                        <input type="text" name="email" disabled value="email@example.com">
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
                        <label for="password_confirmation">New Password</label>
                        <input type="password_confirmation" name="password_confirmation" class="form-control" id="password_confirmation">

                        @error('password_confirmation')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>
