@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div>
                <h4>Mail Templates</h4>
            </div>
            @if(Session::has('msg'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ Session::get('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="response">

            </div>
            <div class="mt-1">
                <button class="btn btn-primary" id="add-new">
                    Add New
                    <i class="fa fa-plus"></i>
                </button>
            </div>

        </section>
        <section class="content">
            <div class="row" >
                <div class="col-sm-8">
                    <div class="box box-primary ease-in" id="add" style="display: none">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add Mail Template</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="form-group">
                                <input class="form-control" placeholder="Subject:" id="subject" name="subject">
                            </div>
                            <div class="form-group">

                                <div id="editor">

                                </div>

                                <input type="hidden" id="mail-body" value="" name="mail-body">
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
{{--                                <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>--}}
                                <button type="submit" class="btn btn-primary send" id="send"><i class="fa fa-plus"></i> Add</button>
{{--                                <button type="submit" class="btn btn-primary fa fa-envelope-o" id="send"><i class=""  id="fa"></i> Send</button>--}}
                            </div>
{{--                            <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>--}}
                        </div>
                    </div>

                    <div class="box box-primary">
                        <table class="table table-primary table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            @forelse($templates as $template)
                                <tr>
                                    <td><a href="/admin/mail/templates/{{ $template->id }}/show">{{ $template->subject }}</a></td>
                                    <td><span style="color: red"><a href="/admin/mail/templates/{{ $template->id }}/delete" >Delete</a></span></td>
                                </tr>

                            @empty
                                <p class="text-center">No Templates Created yet</p>
                            @endforelse
                        </table>
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
            $(document).on('click', '#add-new', function () {
                $('#add').css('display', 'block');
            });

            $('#send').click(function(){
                // alert("Yes");
                // $('#send').attr('disabled', 'disabled');
                // $('#send').removeClass("fa-envelope-o");
                // $('#send').addClass("fa-spinner fa-spin");
                $('.send').html("<i class='fa fa-spinner fa-spin'></i>");
                // $('.send').html("hh");
                let g = $('.ql-editor').html();
                $('#mail-body').val(g);
                axios.post('/admin/mail/templates/save', {
                    subject: $('#subject').val(),
                    body: $('#mail-body').val()
                })
                .then(function(){
                    $('.response').html("<div class='alert alert-success alert-dismissable'>Saved</div>");
                    $('.send').html("<i class='fa fa-envelope-o'></i> Save");
                })

                .catch(function(error){
                    $('.response').addClass('error');
                    if(error.response.status === 422){
                        $('.response').html("Invalid Input: Ensure all inputs are valid");
                        $('.send').html("<i class='fa fa-envelope-o'></i> Send");

                    }

                });
                // $('.send').html("<i class='fa fa-envelope-o'></i> Send");
            })
        });
    </script>
@endsection
