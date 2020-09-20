@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        @if(Session::has('msg'))
            <div class="alert alert-info">
                <p>{{ Session::get("msg") }}  </p>
            </div>
        @endif
        <div id="result" class="alert">

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel p-20">
                <div class=" top-display text-center">Add Publications</div>
                <p id="result"></p>
                <div class="row m-auto">
                    <div class="col-md-2"></div>
                    <div class="panel-body col-md-8">
                        <form action="" method=""  id="form">
                            @csrf
                            <div class="wrap">
                                <div class="form-group">
                                    <label for="title[]">Title</label>
                                    <input type="text" name="title[]" class="form-control" placeholder="Publication Title">
                                </div>
                                <div class="form-group">
                                    <label for="link[]">Publication Link</label>
                                    <input type="text" name="link[]" class="form-control" placeholder="https://example.com/publication">
                                </div>
                                <div class="">
                                    <a href="javascript:void(0);" class="btn btn-info btn-sm add_button">Add Fields</a>
                                </div>

                            </div>
                            <div class="form-group text-center pt-3">
                                <button type="submit" class="btn btn-primary " id="add">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2"></div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('quill')
    <script type="text/javascript">
        $(document).ready(function(){
            let field = '<div>\n' +
                '<div class="form-group mt-3">\n' +
                '                                    <label for="title[]">Title</label>\n' +
                '                                    <input type="text" name="title[]" class="form-control" placeholder="Publication Title" >\n' +
                '                                </div>\n' +
                '                                <div class="form-group">\n' +
                '                                    <label for="link[]">Link</label>\n' +
                '                                    <input type="text" name="link[]" class="form-control" placeholder="https://example.com/publication">\n' +
                '                                </div>\n' +
                '<div class="col-sm-6">\n' +
                '     <button class="btn btn-danger btn-sm remove_button">Remove</button>\n' +
                '</div>\n' +
                '</div>\n';

            let wrap = $('.wrap');
            $('.add_button').click(function () {
                // alert("j");
                wrap.append(field);
            });

            $(wrap).on('click', '.remove_button', function(e){
               e.preventDefault();
               $(this).parent('div').parent('div').remove();
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#add").click(function (e) {
                e.preventDefault();

                var form = $("#form")[0];
                var formData = new FormData(form);
                $.ajax({
                    url: '/publications/add-publication',
                    type: 'post',
                    async: false,
                    processData: false,
                    contentType: false,
                    data: formData,
                    // dataType: 'json',
                    beforeSend: function(){
                        // alert("jk");
                        $('#add').attr('disabled','disabled');
                    },
                    success: function (data) {
                        // alert(data);
                        $('#result').addClass('alert-info');
                        $('#result').html('Opening Posted.. ');
                        window.location.href = "/profile";
                        // }
                    },

                    error:function(x,e) {
                        // var responseText = JSON.parse(x.responseText);
                        let res;
                        if (x.status===0) {
                            res = 'You are offline!!\n Please Check Your Network.';
                        } else if(x.status===404) {
                            res = 'Requested URL not found.';
                        } else if(x.status===500) {
                            res = 'Internal Server Error.';
                        } else if(e==='parsererror') {
                            res = 'Error.\nParsing JSON Request failed.';
                        } else if(e==='timeout'){
                            res = 'Request Time out.';
                        } else if(x.status === 422){
                            // var res = JSON.parse(x.responseText);
                            // alert(res.errors.title);
                            // let t = res + "." + 0;
                            res = "Please Check That all Inputs are entered correctly";
                        } else {
                            res = x.responseText;
                        }
                        $('#result').addClass('alert-danger');
                        $('#result').html(res);
                    }
                });
                $('#add').attr('disabled', false);
                return false;

            })

        })

    </script>
@endsection
