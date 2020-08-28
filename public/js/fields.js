$(document).ready(function(){


    $('#gmat').click(function () {
        if($(this).prop("checked") === true){
            $("#gmat_block").toggleClass("score score_display");
            // $("#gmat_block").toggleClass("ease-in");
        }
        else if($(this).prop("checked") === false){
            $("#gmat_block").toggleClass("score score_display");
        }
    });
    $('#ielts').click(function () {
        if($(this).prop("checked") === true){
            $("#ielts_block").toggleClass("score score_display");
            // $("#ielts_block").toggleClass("ease-in");
        }
        else if($(this).prop("checked") === false){
            $("#ielts_block").toggleClass("score score_display");
        }
    });
    $('#toefl').click(function () {
        if($(this).prop("checked") === true){
            $("#toefl_block").toggleClass("score score_display");
            // $("#toefl_block").toggleClass("ease-in");
        }
        else if($(this).prop("checked") === false){
            $("#toefl_block").toggleClass("score score_display");
        }
    });
    $('#gre').click(function () {
        if($(this).prop("checked") === true){
            $("#gre_block").toggleClass("score score_display");
            // $("#gre_block").toggleClass("ease-in");
        }
        else if($(this).prop("checked") === false){
            $("#gre_block").toggleClass("score score_display");
        }
    });

    $('#profile_photo').click(function(){
        $('#avatar').click()
    });

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.academic_history'); //Input field wrapper
    var x = 1; //Initial field counter is 1
    var fieldHTML =
        '                                    <div class="text-left" id="root">\n' +
        '                                        <div class="form-group " id="kk">\n' +
        '                                            <label for="school">University</label>\n' +
        '                                            <input type="text" class="form-control ach" name="school[]" >\n' +
        '                                        </div>\n' +
        '                                        <div class="form-group">\n' +
        '                                            <label for="course">Program</label>\n' +
        '                                            <input type="text" class="form-control ach " name="course[]">\n' +
        '                                        </div>\n' +
        '                                        <div class="input-group mb-2">\n' +
        '                                            <div class="input-group-prepend">\n' +
        '                                                <label for="certification" class="input-group-text">Degree</label>\n' +
        '                                            </div>\n' +
        '                                            <select type="text" class="custom-select ach " name="certification[]" id="certification">\n' +
        '                                                <option>Select</option>\n' +
        '                                                <option value="Diploma">Diploma</option>\n' +
        '                                                <option value="B.A">Bachelor of Arts</option>\n' +
        '                                                <option value="BSc">Bachelor of Science</option>\n' +
        '                                                <option value="BFA">Bachelor of Fine Arts</option>\n' +
        '                                                <option value="BAS">Bachelor of Applied Science</option>\n' +
        '                                                <option value="MSc">Master of Science</option>\n' +
        '                                                <option value="M.A">Master of Arts</option>\n' +
        '                                                <option value="PhD">Doctor of Philosophy</option>\n' +
        '                                            </select>\n' +

        '                                        </div>\n' +
        '                                        <div class="form-group row">\n' +
        '                                            <div class="col-sm-6">\n' +
        '                                                <label for="start">Start</label>\n' +
        '                                                <input type="date" name="start[]" id="start" class="form-control ach " >\n' +
        '                                            </div>\n' +
        '                                            <div class="col-sm-6">\n' +
        '                                                <label for="end">End</label>\n' +
        '                                                <input type="date" name="end[]" id="end" class="form-control ach " >\n' +

        '                                            </div>\n' +
        '                                        </div>\n' +
        '\n' +
        '                                        <div class="form-group row text-center">\n' +
        '                                            <div class="col-sm-6">\n' +
        '                                                <button class="btn btn-danger btn-sm remove_button">Remove</button>\n' +
        '                                            </div>\n' +
        '                                            <div class="col-sm-6">\n' +
        '                                            </div>\n' +
        '                                        </div>\n' +
        '                                    </div>\n' +
        '                                </div>\n' +
        '                                <div class="col-sm-6"></div>\n' +
        '\n' +
        '                            '

    //Once add button is clicked
    // alert("ll");
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){
            x++; //Increment field counter
            var k = x;
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

    $("#go").click(function(e){
        e.preventDefault();
        var form = $("#profile_setup")[0];
        var formData = new FormData(form);
        // alert(formData);
        $(".error").html("");
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
                        alert("Heylo");
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
                    alert(x.responseText);
                    alert(res.errors.firstName);
                }
            }
    });
        // alert(res.errors);
        $('#go').attr('disabled',false);
        // alert(data);
    });
});
