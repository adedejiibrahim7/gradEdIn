@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Mail</h1>
            <div class="response">

            </div>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
        </section>
        <section class="content">
            <div class="row" >
                <div class="col-sm-8">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Send Custom Mail to All Users</h3>
                        </div>
                        <!-- /.box-header -->
                        <form action="/admin/mail/send-mail/to-all" method="post">
                            @csrf
                            <div class="box-body">
    {{--                            <div class="form-group">--}}
    {{--                                <input class="form-control" placeholder="To:" id="to" name="to" value="{{ $email }}">--}}
    {{--                            </div>--}}
                                <div class="form-group">
                                    <p><b>To:</b></p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="to" id="all" value="all">
                                        <label class="form-check-label" for="all">Everyone</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="to" id="employers" value="employers">
                                        <label class="form-check-label" for="employers">Employers</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="to" id="seekers" value="seekers" >
                                        <label class="form-check-label" for="seekers">Seekers</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Subject:" id="subject" name="subject">
                                </div>
                                <div class="form-group">

                                    <div id="editor">

                                    </div>

                                    <input type="hidden" id="mail-body" value="" name="mail-body">
                                </div>
    {{--                            <div class="form-group">--}}
    {{--                                <div class="btn btn-default btn-file">--}}
    {{--                                    <i class="fa fa-paperclip"></i> Attachment--}}
    {{--                                    <input type="file" name="attachment">--}}
    {{--                                </div>--}}
    {{--                                <p class="help-block">Max. 32MB</p>--}}
    {{--                            </div>--}}
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <div class="pull-right">
    {{--                                <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>--}}
                                    <button type="submit" class="btn btn-primary send" id="send"><i class="fa fa-envelope-o"></i> Send</button>
    {{--                                <button type="submit" class="btn btn-primary fa fa-envelope-o" id="send"><i class=""  id="fa"></i> Send</button>--}}
                                </div>
    {{--                            <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>--}}
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </section>
        <!-- /.box-footer -->
        <!-- /. box -->

    </div>
@endsection

@section('oneScript')
    <script>
        $(function () {
            //Add text editor
            // $("#compose-textarea").wysihtml5();
            var quill = new Quill('#editor', {
                theme: 'snow'
            });

            // const axios = require('axios').default;

            $('#send').click(function(){

                $('.send').html("<i class='fa fa-spinner fa-spin'></i>");
                // $('.send').html("hh");
                let g = $('.ql-editor').html();
                $('#mail-body').val(g);
                // axios.post('/admin/mail/send-mail/to-all', {
                //     subject: $('#subject').val(),
                //     mailBody: $('#mail-body').val()
                // })
                // .then(function(){
                //     $('.response').html("<div class='alert alert-success'>The mail is on its way</div>");
                //     $('.send').html("<i class='fa fa-envelope-o'></i> Send");
                // })
                //
                // .catch(function(error){
                //     $('.response').addClass('error');
                //     if(error.response.status === 422){
                //         $('.response').html("Invalid Input: Ensure all inputs are valid");
                //         $('.send').html("<i class='fa fa-envelope-o'></i> Send");
                //
                //     }
                //
                // });
                // $('.send').html("<i class='fa fa-envelope-o'></i> Send");
            })
        });
    </script>
@endsection
