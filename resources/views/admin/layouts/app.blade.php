<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GradEdIn') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('admin/css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/skin-blue.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    {{--    <link href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">--}}
    {{--    <link rel="stylesheet" href="{{ asset('assets/components/dropify/dist/css/dropify.min.css') }}">--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">--}}
{{--    <link href="{{ asset('assets/components/custom-select/custom-select.css') }}" rel="stylesheet" type="text/css" />--}}
    {{--    <link href="{{ asset('assets/components/switchery/dist/switchery.min.css') }}" rel="stylesheet" />--}}
    {{--    <link href="{{ asset('assets/components/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" />--}}
    <link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div id="app wrapper">
    <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>GE</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">GradEdIn</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
{{--                    <li class="dropdown messages-menu">--}}
{{--                        <!-- Menu toggle button -->--}}
{{--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                            <i class="fa fa-envelope-o"></i>--}}
{{--                            <span class="label label-success">4</span>--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            <li class="header">You have 4 messages</li>--}}
{{--                            <li>--}}
{{--                                <!-- inner menu: contains the messages -->--}}
{{--                                <ul class="menu">--}}
{{--                                    <li><!-- start message -->--}}
{{--                                        <a href="#">--}}
{{--                                            <div class="pull-left">--}}
{{--                                                <!-- User Image -->--}}
{{--                                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}
{{--                                            </div>--}}
{{--                                            <!-- Message title and timestamp -->--}}
{{--                                            <h4>--}}
{{--                                                Support Team--}}
{{--                                                <small><i class="fa fa-clock-o"></i> 5 mins</small>--}}
{{--                                            </h4>--}}
{{--                                            <!-- The message -->--}}
{{--                                            <p>Why not buy a new awesome theme?</p>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- end message -->--}}
{{--                                </ul>--}}
{{--                                <!-- /.menu -->--}}
{{--                            </li>--}}
{{--                            <li class="footer"><a href="#">See All Messages</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <!-- /.messages-menu -->

                    <!-- Notifications Menu -->
{{--                    <li class="dropdown notifications-menu">--}}
{{--                        <!-- Menu toggle button -->--}}
{{--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                            <i class="fa fa-bell-o"></i>--}}
{{--                            <span class="label label-warning">10</span>--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            <li class="header">You have 10 notifications</li>--}}
{{--                            <li>--}}
{{--                                <!-- Inner Menu: contains the notifications -->--}}
{{--                                <ul class="menu">--}}
{{--                                    <li><!-- start notification -->--}}
{{--                                        <a href="#">--}}
{{--                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- end notification -->--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li class="footer"><a href="#">View all</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <!-- Tasks Menu -->
{{--                    <li class="dropdown tasks-menu">--}}
{{--                        <!-- Menu Toggle Button -->--}}
{{--                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                            <i class="fa fa-flag-o"></i>--}}
{{--                            <span class="label label-danger">9</span>--}}
{{--                        </a>--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            <li class="header">You have 9 tasks</li>--}}
{{--                            <li>--}}
{{--                                <!-- Inner menu: contains the tasks -->--}}
{{--                                <ul class="menu">--}}
{{--                                    <li><!-- Task item -->--}}
{{--                                        <a href="#">--}}
{{--                                            <!-- Task title and progress text -->--}}
{{--                                            <h3>--}}
{{--                                                Design some buttons--}}
{{--                                                <small class="pull-right">20%</small>--}}
{{--                                            </h3>--}}
{{--                                            <!-- The progress bar -->--}}
{{--                                            <div class="progress xs">--}}
{{--                                                <!-- Change the css width attribute to simulate progress -->--}}
{{--                                                <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">--}}
{{--                                                    <span class="sr-only">20% Complete</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <!-- end task item -->--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li class="footer">--}}
{{--                                <a href="#">View all tasks</a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
{{--                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">--}}
                            <!-- hidden-xs hides the username on small devices so only the image appears.  -->
{{--                            <span class="hidden-xs">Alexander Pierce</span>--}}
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
{{--                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}

                                <p>
{{--                                    Alexander Pierce - Web Developer--}}
{{--                                    <small>Member since Nov. 2012</small>--}}
                                </p>
                            </li>
                            <!-- Menu Body -->
{{--                            <li class="user-body">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-xs-4 text-center">--}}
{{--                                        <a href="#">Followers</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-4 text-center">--}}
{{--                                        <a href="#">Sales</a>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xs-4 text-center">--}}
{{--                                        <a href="#">Friends</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- /.row -->--}}
{{--                            </li>--}}
                            <!-- Menu Footer-->
                            <li class="user-footer">
{{--                                <div class="pull-left">--}}
{{--                                    <a href="#" class="btn btn-default btn-flat">Profile</a>--}}
{{--                                </div>--}}
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mb-3">
                <div class="pull-left image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- search form (Optional) -->
{{--            <form action="#" method="get" class="sidebar-form">--}}
{{--                <div class="input-group">--}}
{{--                    <input type="text" name="q" class="form-control" placeholder="Search...">--}}
{{--                    <span class="input-group-btn">--}}
{{--                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
{{--                </button>--}}
{{--              </span>--}}
{{--                </div>--}}
{{--            </form>--}}
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
{{--                <li class="header">HEADER</li>--}}
                <!-- Optionally, you can add icons to the links -->
                <li class="active"><a href="#"><i class="fa fa-users"></i> <span>Users</span></a></li>
                <li><a href="#"><i class="fas fa-door-open"></i> <span>Openings</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#">Link in level 2</a></li>
                        <li><a href="#">Link in level 2</a></li>
                    </ul>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <main class="py-4 " role="main">
        <div id="app">
            @yield('content')
        </div>
    </main>
</div>

{{--@section('footer')--}}
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
{{--            Anything you want--}}
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ date("Y") }} <a href="#">GradEdIn, a DOUBLELEADS INC. Company</a>.</strong> All rights reserved.
    </footer>
{{--@endsection--}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
{{--<script src="https://cdn.quilljs.com/1.3.6/quill.js" ></script>--}}
<script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}" ></script>
{{--<script src="{{ asset('admin/js/app.min.js') }}" ></script>--}}
<script src="{{ asset('admin/js/app.js') }}" defer></script>
<script src="https://kit.fontawesome.com/04d124077d.js" crossorigin="anonymous"></script>

{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
</body>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}


{{--<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>--}}

{{--    <script src="{{ asset('assets/components/dropify/dist/js/dropify.js') }}" defer></script>--}}
{{--    <script src="/assets/components/dropify/dist/js/dropify.js"></script>--}}
{{--    <script src="{{ asset('assets/components/custom-select/custom-select.min.js') }}" type="text/javascript" ></script>--}}
    {{--    <script src="{{ asset('assets/components/bootstrap-select/bootstrap-select.min.js') }}" type="text/javascript" ></script>--}}
{{--    <script src="{{ asset('assets/components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}" ></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" type="text/javascript" defer></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" type="text/javascript" defer></script>--}}

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
