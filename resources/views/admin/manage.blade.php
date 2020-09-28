@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper" style="min-height: 566px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1 class="">
                Manage Admins
                {{--            <small>Optional description</small>--}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
                <li class="active">Manage</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

             <div class="row">
                 <div class="col-sm-8">
                     <div class="box box-info">
                         <div class="box-header">
                             Create Admin
                         </div>

                         <form action="" id="create_user">
                             <div class="box-body">
                                 <div class="form-group">
                                     <label for="email">Email</label>
                                     <input type="text" class="form-control " id="email" name="email" placeholder="example@email.com">
                                 </div>

                                 <div class="form-group">
                                     <label for="level">User Level</label>
                                     <select name="level" id="level" class="form-control">
                                         <option value="admin">Admin</option>
                                     </select>
                                 </div>

                             </div>

                             <div class="box-footer">
                                 <div>
                                     <button type="submit" id="create_admin" class="btn btn-info">Create Admin</button>
                                 </div>
                             </div>

                         </form>

                     </div>
                 </div>
             </div>

        </section>
        <!-- /.content -->
    </div>
@endsection

@section('read_more')
    <script>
        $(function () {
            $('#create_admin').click(function(){
                e.preventDefault();
                var form = $("#create_user")[0];
                var formData = new FormData(form);
                // alert(formData);
                // $(".error").html("");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/p',
                    type: 'post',
                    async: false,
                    processData: false,
                    contentType: false,
                    data: formData,
                    // dataType: 'json',
                    beforeSend:function(){
                        // alert("jk");
                        $('#go').attr('disabled','disabled');
                    },
                    success: function (data) {
                        // alert(data);
                        $('#result').html('Gone!');
                        $('#result').html('<div class="alert alert-success">Profile Created.. redirecting</div>');
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
                            if (res.errors.avatar) {
                                $("#avatarRes").html("Please upload profile photo");
                            }
                            if (res.errors.title) {
                                $("#titleRes").html("Please choose a title");
                            }
                            if (res.errors.firstName) {
                                $("#firstNameRes").html(res.errors.firstName);
                            }
                            if (res.errors.lastName) {
                                $("#lastNameRes").html(res.errors.lastName);
                            }
                            if (res.errors.bio) {
                                $("#bioRes").html(res.errors.bio);
                            }
                            var t;
                            for (t = 0; t < 10; t++) {


                                var j = 'school' + "." +t;
                                var k = 'course' + "." +t;
                                var l = 'certification' + "."+t;
                                var m = 'start' + "." +t;
                                var n = 'end' + "." +t;
                                if (j in res.errors || k in res.errors || l in res.errors || m in res.errors || n in res.errors) {
                                    var yy = "Please check that academic history is filled completely"
                                }
                            }
                            $("#achRes").html(yy);
                            if('school' in res.errors){
                                // alert("Heylo");
                            }
                            if(res.errors.gre){
                                $("#greRes").html(res.errors.gre);
                            }
                            if(res.errors.toefl){
                                $("#toeflRes").html(res.errors.toefl);
                            }
                            if(res.errors.gmat){
                                $("#gmatRes").html(res.errors.gmat);
                            }
                            if(res.errors.ielts){
                                $("#ieltsRes").html(res.errors.ielts);
                            }
                            if(res.errors.cv){
                                $("#cvRes").html(res.errors.cv);
                            }
                            if(res.errors.cover_letter){
                                $("#cover_letterRes").html(res.errors.cover_letter);
                            }
                            // alert(x.responseText);
                            // alert(res.errors.firstName);
                        }
                    }
                });
                $('#go').attr('disabled',false);
            });
        })
    </script>
@endsection
