@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        @if(Session::has('msg'))
            <div class="alert alert-info">
                <p>{{ Session::get("msg") }}  </p>
            </div>
        @endif
        <div id="result">

        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel p-20">
                <div class=" top-display text-center">Post an Opening</div>

                <div class="panel-body">
                    <form action="/o" method="post" enctype="multipart/form-data" id="form">
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

                            <div class="form-group">
                                <label for="description">Description</label>
{{--                                <textarea type="text" name="description" rows="10" cols="100" class="form-control @error('description') is-invalid @enderror" ></textarea>--}}
                                <div id="editor">

                                </div>
                                <input type="hidden" name="description" id="description">
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


                                <b>Timeframe (Optional)</b>
                                <hr>
                                <div class="form-group row">
                                <div class="col-sm-6">
                                    <label for="open">Open (Optional)</label>
                                    <input type="datetime-local" name="open" id="open" class="form-control-small @error('open') is-invalid @enderror" >
                                    @error('open')
                                    <span>{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <label for="close">Close (Optional)</label>
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
                                <div class="input-group mb-2">
{{--                                    <div class="">--}}
                                        <label for="tags">Tags</label>
{{--                                    </div>--}}
{{--                                    <div>--}}
                                        <input type="text" class="form-control-lg" name="tags[]" data-role="tagsinput">
{{--                                    </div>--}}
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary btn-lg" id="post">Post</button>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('quill')
    <script type="text/javascript">
        // alert("kk");
        $(document).ready(function(){
            var quill = new Quill('#editor', {
                // modules: {
                //     toolbar: [
                //         [{ header: [1, 2, false] }],
                //         ['bold', 'italic', 'underline'],
                //     ]
                // },
                theme: 'snow'
            });
            // alert("Hello");
            $("#post").click(function (e) {
                e.preventDefault();
                var t = $("#editor").children().html();
                $("#description").val(t);
                // alert($("#description").val());
                // alert($("#description").val(t));
                var form = $("#form")[0];
                var formData = new FormData(form);
                alert(formData);
                $.ajax({
                    url: '/o',
                    type: 'post',
                    async: false,
                    processData: false,
                    contentType: false,
                    data: formData,
                    // dataType: 'json',
                    beforeSend:function(){
                        // alert("jk");
                        $('#post').attr('disabled','disabled');
                    },
                    success: function (data) {
                        // alert(data);
                        $('#result').html('Gone!');
                        $('#result').html('<div class="alert alert-success">Opening Posted.. redirecting</div>');
                        window.location.href = "/home";
                        // }
                    },

                    error:function(x,e) {
                        if (x.status===0) {
                            alert('You are offline!!\n Please Check Your Network.');
                        } else if(x.status===404) {
                            alert('Requested URL not found.');
                        } else if(x.status===500) {
                            alert('Internel Server Error.');
                        } else if(e==='parsererror') {
                            alert('Error.\nParsing JSON Request failed.');
                        } else if(e==='timeout'){
                            alert('Request Time out.');
                        } else {
                            var res = JSON.parse(x.responseText);
                            alert(res);
                        }
                    }
                });
                return false;
                $('#post').attr('disabled',false);

            })
            // var form = document.querySelector('form');
            // form.onsubmit = function() {
            //     event.preventDefault();
            //     alert("hello");
            //     // Populate hidden form on submit
            //     var description = document.querySelector('input[name=description]');
            //     description.value = JSON.stringify(quill.getContents());
            //     alert(description.value);
            //     // console.log("Submitted", $(form).serialize(), $(form).serializeArray());
            //
            //     // No back end to actually submit to!
            //     // alert('Open the console to see the submit data!')
            //     return false;
            // };
        })

    </script>
@endsection
