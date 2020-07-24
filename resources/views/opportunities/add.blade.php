@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        @if(Session::has('msg'))
            <div class="alert alert-info">
                <p>{{ Session::get("msg") }}  </p>
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel p-20">
                <div class="panel-heading display-4 text-center">Post an opportunity</div>

                <div class="panel-body">
                    <form action="/o" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <div class="">
                                <div class="">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" >
                                        @error('title')
                                        <span>{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
{{--                                <div class="col-sm-6">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="media">Media</label>--}}
{{--                                        <input type="file" name="media" class="form-control-file @error('media') is-invalid @enderror" >--}}
{{--                                        @error('media')--}}
{{--                                        <span>{{$message}}</span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" name="description" rows="10" cols="100" class="form-control @error('description') is-invalid @enderror" ></textarea>
                                @error('description')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="link">Link (Optional)</label>
                                <input type="text" name="link" class="form-control @error('link') is-invalid @enderror" >
                                @error('link')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="media">Media (Optional) </label>
                                <input type="file" name="media" class="form-control-file @error('media') is-invalid @enderror" >
                                @error('media')
                                    <span>{{$message}}</span>
                                @enderror
                            </div>

                                <b>Timeframe (Optional)</b>
                                <hr>
                                <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="open">Open</label>
                                    <input type="datetime-local" name="open" id="open" class="form-control-small @error('open') is-invalid @enderror" >
                                    @error('open')
                                    <span>{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="close">Close</label>
                                    <input type="datetime-local" name="close" class="form-control-small @error('close') is-invalid @enderror" >
                                    @error('close')
                                    <span>{{$message}}</span>
                                    @enderror
                                </div>


                            </div>
                                <div class="form-group ml-3 pt-2">
                                    <input type="checkbox" name="take_app" id="take_app" class="form-check-input">
                                    <label for="take_app" class="form-check-label">Take On-site Applications</label>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Post</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
