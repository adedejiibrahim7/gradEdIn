<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>GradEdIn</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
          content="gradedin" />
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta tag Keywords -->
    <!--/Style-CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/h-style.css') }}" type="text/css" media="all" />
    <!--//Style-CSS -->
</head>

<body>
<!-- /login-section -->
<section class="w3l-login-6">
    <div class="login-hny">
        <div class="form-content">
            <div class="form-right">
                <div class="overlay">
                    <div class="grid-info-form">
{{--                        <h5>Say hello</h5>--}}
                        <h3>Find Opportunities</h3>
                        <p>GradEdIn Connects you to Opportunities, and the Best Minds</p>
                        <a href="/register" class="read-more-1 btn">Get Started</a>
                    </div>

                </div>
            </div>
            <div class="form-left">
                <div class="middle">
                    <img src="{{ asset('img/gradedin7.png') }}" alt="">
                </div>
                <form action="{{ route('login') }}" method="post" class="signin-form">
                    @csrf

                    <div class="form-input">
                        <label>Email</label>

                        <input type="email" class="@error('email') is-invalid @enderror" name="email" placeholder=""  />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label>Password</label>
                        <input type="password" name="password" class="@error('password') is-invalid @enderror" id="password" placeholder="" required />

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                    </div>
                    <div class="row mt-2">

                        <div class="col">
                            <div class="form-check">
                                <label for="remember" class="container" style="font-size: 13px; font-weight: normal;">Remember Me
                                    <input type="checkbox" name="remember" id="remember">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col text-right">
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="font-size: 12px; margin-top: 2px; margin-bottom: 2px;">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>


                    </div>


{{--                    <label class="container">Remember Me--}}
{{--                        <input type="checkbox">--}}
{{--                        <span class="checkmark"></span>--}}
{{--                    </label>--}}

                    <button class="btn">Login</button>
                </form>
                <div class="footer text-center">
                    <span><a href="#">Resources | </a></span>
                    <span><a href="#">Blog </a></span>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- //login-section -->
</body>

</html>
