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
                         <form action="" method="post" id="create_user">
                             <div class="box-body">
                                 <p class="text-danger small" id="response"></p>

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
            $('#create_admin').click(function(e){
                e.preventDefault();
                // alert("u");
                let user = $('#user').val();
                let form = $("#create_user")[0];
                let formData = new FormData(form);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/admin/user/create',
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
                        // $('#result').html('Gone!');
                        // $('#result').html('<div class="alert alert-success">Profile Created.. redirecting</div>');
                        // window.location.href = "/home";
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
                        } else if(x.status === 422){
                           $('#response').html("Please enter a valid email address");
                        }
                    }
                });
                // $('#go').attr('disabled',false);
            });
        })
    </script>
@endsection
