@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 566px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="">
             Users - Employers
{{--            <small>Optional description</small>--}}
        </h1>
{{--        <ol class="breadcrumb">--}}
{{--            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>--}}
{{--            <li class="active">Here</li>--}}
{{--        </ol>--}}
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{ App\User::count() }}</h3>

                        <p>Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-users"></i>
                    </div>
                    <a href="/admin/users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{ App\User::where('user_type', "seeker")->count() }}</h3>

                        <p>Job Seekers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-users"></i>
                    </div>
                    <a href="/admin/seekers" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua-active">
                    <div class="inner">
                        <h3>{{ App\User::where('user_type', "recruiter")->count() }}</h3>

                        <p>Employers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-users"></i>
                    </div>
                    <a href="/admin/recruiters" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{ App\User::where('is_admin', true)->count() }}</h3>

                        <p>Admins</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-users"></i>
                    </div>
                    <a href="/admin/admins" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>


        <div>
            <div class="box">
                <div class="box-header">
                    <p class="">All Users</p>
                </div>
                <div class="box-body">

                    <table id="my_table" class="table table-responsive table-striped">
                        <thead>
                        <tr>
                            <th>S/N</th>
                            <th>User</th>
                            <th>User Type</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if(!$user->is_admin)
                                        <a target="_blank" href="/profile/{{ $user->id }}">
                                            @if($user->user_type == "recruiter" )
                                                @if($user->employerprofile)
                                                    {{ $user->employerprofile->first_name }} {{ $user->employerprofile->last_name }}
                                                @else
                                                    User
                                                @endif
                                            @elseif($user->user_type == "seeker")
                                                @if($user->profile)
                                                    {{ $user->profile->first_name }} {{ $user->profile->last_name }}
                                                @else
                                                    User
                                                @endif
                                            @endif
                                        </a>
                                    @else
                                        {{ $user->admin->name ?? "Admin"}}
                                    @endif
                                </td>
                                <td>
                                    @if($user->is_admin)
                                        Admin
                                    @else
                                        {{ $user->user_type }}
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a id="dropdownMenuButton" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                            <i class="fas fa-edit " ></i>
                                        </a>
                                        <div class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton">
                                            <p class="dropdown-header" >Change Status To:</p>
                                            <p><a class="dropdown-header" href="/approve/{{ $user->id }}">Active</a></p>
                                            <p><a class="dropdown-header" href="/close/{{ $user->id }}">Closed</a></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p>No records</p>
                        @endforelse
                        </tbody>

                        <tfooter>
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>User</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                        </tfooter>

                    </table>
                </div>
            </div>
        </div>
        <ul class="pagination">
            {{ $users->links() }}
        </ul>

        <div>
            <p>Users whose names are displayed as "User" are those who are yet to fill their profile details</p>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection

@section('oneScript')
    <script>

    </script>
@endsection
