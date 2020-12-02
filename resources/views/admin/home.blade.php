@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 566px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="">
             Admin Dashboard
{{--            <small>Optional description</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{ $data['users'] }}</h3>

                        <p>Registered Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-users"></i>
                    </div>
                    <a href="{{ route('admin.users') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3>{{ $data['active-openings'] }}</h3>

                        <p>Active Openings</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua-active">
                    <div class="inner">
                        <h3>{{ $data['signup-count'] }}</h3>

                        <p>Signups (Last 24 hrs)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{ $data['login-count'] }}</h3>

                        <p>Logins (Last 24hrs)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div>
            <div class="row">
                <div class="col-sm-4 col-xs-12 p-4">
                    <div class="panel">
                        <h5>Last 5 Signups</h5>
                        <table class="table table-striped table-responsive">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>When</th>
                            </thead>

                            @forelse($data['new-signups'] as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ getFullName($user->id) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                                </tr>

                                @empty
                                <p class="text-center">No new Signups</p>
                            @endforelse
                        </table>
                    </div>
                </div>

                <div class="col-sm-4 col-xs-12 p-4">
                    <div class="panel">
                        <h5>Last 5 Openings Posted</h5>
                        <table class="table table-striped table-responsive">
                            <thead>
                                <th>#</th>
                                <th>Title</th>
{{--                                <th>By</th>--}}
                                <th>When</th>
                            </thead>

                            @forelse($data['new-openings'] as $opening)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-responsive">{{ $opening->title }}</td>
{{--                                    <td>{{ getFullName($opening->user->id) }}</td>--}}
                                    <td>{{ \Carbon\Carbon::parse($opening->created_at)->diffForHumans() }}</td>

                                </tr>
                                @empty
                            <p class="text-center">No new openings</p>
                            @endforelse
                        </table>
                    </div>
                </div>

                <div class="col-sm-4 col-xs-12 p-4">
                    <div class="panel">
                        <h5>Last 5</h5>
                        <table class="table table-striped table-responsive">
                            <thead>
                                <th>#</th>
                                <th>Title</th>
                                <th>By</th>
                                <th>When</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
@endsection
