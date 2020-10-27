@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper" style="min-height: 566px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="">
                Openings - Active
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
                            <h3>{{ App\Opportunity::count() }}</h3>

                            <p>Openings Posted</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-users"></i>
                        </div>
                        <a href="/admin/openings" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3>{{ App\Opportunity::where('status', "active")->count() }}</h3>

                            <p>Active Openings</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-users"></i>
                        </div>
                        <a href="/admin/openings/active" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua-active">
                        <div class="inner">
                            <h3>{{ App\Opportunity::where('status', "pending")->count() }}</h3>

                            <p>Pending Openings</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-users"></i>
                        </div>
                        <a href="/admin/openings/pending" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-blue">
                        <div class="inner">
                            <h3>{{ App\Opportunity::where('status', "closed")->count() }}</h3>

                            <p>Closed Openings</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-users"></i>
                        </div>
                        <a href="/admin/openings/closed" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div>
                <div class="box">
                    <div class="box-header">
                        <p class="">All Active Openings, in reverse order of posting</p>
                    </div>
                    <div class="box-body">

                        <table id="my_table" class="table table-responsive table-striped">
                            <thead>
                            <tr>
                                <td>S/N</td>
                                <td>Post</td>
                                <td>Posted By</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($openings as $opening)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <p>
                                            <a target="_blank" href="/openings/{{ $opening->id }}">{{ $opening->title }}</a>
                                        </p>
                                        {{--                        <p>{{ $opening-> }}</p>--}}
                                    </td>
                                    <td>
                                        <a target="_blank" href="/profile/{{ $opening->user->id }}">
                                            @if($opening->user->employerprofile)
                                                {{ $opening->user->employerprofile->first_name }} {{ $opening->user->employerprofile->last_name }}
                                            @else
                                                User
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        {{ $opening->status }}
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <a id="dropdownMenuButton" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                                <i class="fas fa-edit " ></i>
                                            </a>
                                            <div class="dropdown-menu p-1" aria-labelledby="dropdownMenuButton">
                                                <p class="dropdown-header" >Change Status To:</p>
                                                <p><a class="dropdown-header" href="/approve/{{ $opening->id }}">Active</a></p>
                                                <p><a class="dropdown-header" href="/close/{{ $opening->id }}">Closed</a></p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <p>No records</p>
                            @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
            <ul class="pagination">
                {{ $openings->links() }}
            </ul>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('oneScript')
    <script>

    </script>
@endsection
