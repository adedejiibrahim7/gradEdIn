<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GradEdIn') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{--    <link href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">--}}
{{--    <link rel="stylesheet" href="{{ asset('assets/components/dropify/dist/css/dropify.min.css') }}">--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
    <link href="{{ asset('assets/components/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />
{{--    <link href="{{ asset('assets/components/switchery/dist/switchery.min.css') }}" rel="stylesheet" />--}}
{{--    <link href="{{ asset('assets/components/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />--}}
    <link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
{{--                <div class="logo">--}}
                    <a class="navbar-left " href="{{ url('/home') }}">
                        <img src="{{ asset('img/gradedin7.png') }}" alt="GradEdIn" >
{{--                        GradEdIn--}}
                    </a>
{{--                </div>--}}

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            @if(auth()->user()->user_type == "recruiter" && auth()->user()->employerprofile != null)
                                <li class="nav-item">
                                    <a class="nav-link" href="/home">Dashboard</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="/my-openings">Openings Posted</a>
                                </li>

{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link" href="">Profile</a>--}}
{{--                                </li>--}}

                            @elseif(auth()->user()->user_type == "seeker" && auth()->user()->profile != null)
                                <li class="nav-item">
                                    <a class="nav-link" href="/my-applications">My Applications</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/saved-openings">Saved Openings</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     <span class="fa fa-user"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                   @if(auth()->user()->user_type == "recruiter" && auth()->user()->employerprofile != null)
                                        <a href="/profile/{{ auth()->user()->id }}" class="dropdown-item">My Profile</a>
                                    @elseif(auth()->user()->user_type = "seeker" && auth()->user()->profile != null)
                                        <a href="/profile/{{ auth()->user()->id }}" class="dropdown-item">My Profile</a>
                                    @endif
                                   <a href="/settings" class="dropdown-item">Settings <span class="fa fa-gear"></span></a>

                                   <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                   </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4" role="main">
            @yield('content')
        </main>
    </div>
</body>
<script src="https://cdn.quilljs.com/1.3.6/quill.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/04d124077d.js" crossorigin="anonymous"></script>

{{--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>--}}

{{--    <script src="{{ asset('assets/components/dropify/dist/js/dropify.js') }}" defer></script>--}}
{{--    <script src="/assets/components/dropify/dist/js/dropify.js"></script>--}}
{{--    <script src="{{ asset('assets/components/custom-select/custom-select.min.js') }}" type="text/javascript" ></script>--}}
{{--    <script src="{{ asset('assets/components/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript" ></script>--}}
{{--    <script src="{{ asset('assets/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}" ></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" type="text/javascript" defer></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" type="text/javascript" defer></script>

@yield('add_form')
@yield('read_more')
@yield('oneScript')
@yield('quill')
    <script>
        $(function() {
            // alert("kk");
        //     $('.dropify').dropify();
        //     $(".select2").select2();
        //     // $(".school").select2();
        //
        });
    </script>
</html>
