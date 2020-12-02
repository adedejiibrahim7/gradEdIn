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
    <link href="{{ asset('admin_assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/searchpanes/1.2.0/css/searchPanes.dataTables.css"/>
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>--}}
    <link href="{{ asset('admin_assets/css/AdminLTE.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/skin-blue.min.css') }}" rel="stylesheet">

    {{--    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />--}}
    {{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/r-2.2.6/sp-1.2.0/datatables.css"/>--}}
    {{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.0/datatables.min.css"/>--}}





    {{--    <link href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">--}}
    {{--    <link rel="stylesheet" href="{{ asset('assets/components/dropify/dist/css/dropify.min.css') }}">--}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
{{--    <link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />--}}
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

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
{{--                            <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">--}}
                            <span class="fa fa-user"></span>
                            <!-- hidden-xs hides the username on small devices so only the image appears.  -->
{{--                            <span class="hidden-xs">Alexander Pierce</span>--}}
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
{{--                            <li class="user-header">--}}
{{--                                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">--}}

{{--                                <p>--}}
{{--                                    Alexander Pierce - Web Developer--}}
{{--                                    <small>Member since Nov. 2012</small>--}}
{{--                                </p>--}}
{{--                            </li>--}}
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
{{--                                    <a href="#" class="btn btn-default btn-flat">Sign out</a>--}}
                                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
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
    <aside class="main-sidebar" style="min-height: 1024px;">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" >

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mb-3">
                @if(auth()->user()->admin)
                    <div class="pull-left image">
                        <img src="{{ auth()->user()->admin->avatar ?? "ll" }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{ auth()->user()->admin->name }}</p>
                        <!-- Status -->
{{--                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>--}}
                    </div>
                    @else
                    <div class="pull-left info mb-1">
                        <p>Admin</p>
                    </div>
                @endif
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
                <li class=""><a href="/admin/users"><i class="fa fa-users"></i> <span>Users</span></a></li>
                <li class="treeview">
                    <a href="/admin/openings">
                        <i class="fas fa-door-open"></i> <span>Openings</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        <li><a href="/admin/openings/pending">Pending Approval</a></li>
                        <li><a href="/admin/openings/active">Active Openings</a></li>
                        <li><a href="/admin/openings/closed">Closed Openings</a></li>
                    </ul>
                </li>
                <li><a href="/admin/manage"><i class="fas fa-users"></i> <span>Manage Admins</span></a></li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-envelope"></i> <span>Send Mail</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="/admin/mail">Send Custom Mail</a></li>
                        <li><a href="/admin/mail/to-all">Mail All Users</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="{{ route('admin.mail.templates') }}"><i class="fas fa-file-alt"></i>  <span> Mail Templates</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>

                            <a href="{{ route('admin.mail.templates') }}">Mail Templates</a></li>
                        <li><a href=""></a></li>
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
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/sp-1.2.0/datatables.min.js"></script>
{{--<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>--}}

<script src="https://cdn.quilljs.com/1.3.6/quill.js" ></script>
{{--<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/r-2.2.6/sp-1.2.0/datatables.js" defer></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>--}}
<script src="{{ asset('admin_assets/bootstrap/js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('admin_assets/js/app.js') }}" ></script>
{{--<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>--}}
{{--<script src="{{ asset('admin_assets/js/app.min.js') }}" ></script>--}}
<script src="https://kit.fontawesome.com/04d124077d.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}
</body>

@yield('add_form')
@yield('read_more')
@yield('oneScript')
@yield('quill')
<script>
    $(function() {
        $('#my_table').Datatable({
            searching: true,
            ordering: true
        });
        alert("Hello");

    });
</script>
</html>
