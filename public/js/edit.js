$(document).ready(function(){
    let u = 0;
    let v = 0;
    let w = 0;
    $(document).on('click', '#pf-e', function () {
        v++;
        $('.pf').attr('disabled', false);
        let pf_save = '<div>\n' +
            '                                    <button  class="btn btn-sm btn-info" id="pf_save">Save</button>\n' +
            '                                </div>';
        if(v == 1){
            $('#pf').append(pf_save);
        }
    });

    $(document).on('click', '#p-change', function (e) {
        e.preventDefault();
        $('#avatar').click();
    });

    $(document).on('click', '#pf_save', function () {
        let form = $("#pf")[0];
        let formData = new FormData(form);
        // console.log(...formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/profile/update',
            type: 'post',
            async: false,
            processData: false,
            contentType: false,
            data: formData,
            // dataType: 'json',
            beforeSend:function(){
                $('#pd_save').attr('disabled','disabled');
            },
            success: function (data) {
                // let str = 'Saved <span class="fa fa-check"></span>';
                let str = 'Saved ';
                $('#pd_save').text(str)
                // window.location.href = "/home";
            },

            error:function(x,e) {
                if (x.status===0) {
                    alert('You are offline!!\n Please Check Your Network.');
                } else if(x.status===404) {
                    alert('Requested URL not found.');
                } else if(x.status===500) {
                    alert('Internal Server Error.');
                } else if(e==='parsererror') {
                    alert('Error.\nParsing JSON Request failed.');
                } else if(e==='timeout'){
                    alert('Request Time out.');
                } else {
                    alert("kk");
                }
            }
        });
        $('#pf_save').attr('disabled',false);
        return false;
    });

    $('#pd-e').click(function () {
        u++;
        $('.pde').attr('disabled', false);
        let pd_save = '<div>\n' +
            '                                    <button  class="btn btn-sm btn-info" id="pd_save">Save</button>\n' +
            '                                </div>';
        if(u == 1){
            $('#personal-details').append(pd_save);
        }
    });



    $(document).on('click', '#pd_save', function () {
        // alert("HH");
        let form = $("#pf")[0];
        let formData = new FormData(form);
        console.log(...formData);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/profile/update',
            type: 'post',
            async: false,
            processData: false,
            contentType: false,
            data: formData,
            // dataType: 'json',
            beforeSend:function(){
                $('#pf_save').attr('disabled','disabled');
            },
            success: function (data) {

                // let str = 'Saved <span class="fa fa-check"></span>';
                let str = 'Saved ';
                $('#pf_save').text(str)
                // window.location.href = "/home";
                // }
            },

            error:function(x,e) {
                if (x.status===0) {
                    alert('You are offline!!\n Please Check Your Network.');
                } else if(x.status===404) {
                    alert('Requested URL not found.');
                } else if(x.status===500) {
                    alert('Internal Server Error.');
                } else if(e==='parsererror') {
                    alert('Error.\nParsing JSON Request failed.');
                } else if(e==='timeout'){
                    alert('Request Time out.');
                } else {
                    alert("Error");
                }
            }
        });
        $('#pd_save').attr('disabled',false);
        return false;
    });

    $(document).on('click', '#ach-e', function () {
        w++;
        $('.ach').attr('disabled', false);
        if(w == 1){
            let ach_save = '<div>\n' +
                '                                    <button  class="btn btn-sm btn-info" id="ach_save">Save</button>\n' +
                '                                </div>';
            $('#academic_history').append(ach_save);

        }
    });

    $(document).on('click', '#ach_save', function(){
        let form = $('#academic_history')[0];
        let formData = new FormData(form);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/profile/update',
            type: 'post',
            async: false,
            processData: false,
            contentType: false,
            data: formData,
            // dataType: 'json',
            beforeSend:function(){
                $('#ach_save').attr('disabled','disabled');
            },
            success: function (data) {
                // let str = 'Saved <span class="fa fa-check"></span>';
                let str = 'Saved ';
                $('#ach_save').text(str)
                // window.location.href = "/home";
            },

            error:function(x,e) {
                if (x.status===0) {
                    alert('You are offline!!\n Please Check Your Network.');
                } else if(x.status===404) {
                    alert('Requested URL not found.');
                } else if(x.status===500) {
                    alert('Internal Server Error.');
                } else if(e==='parsererror') {
                    alert('Error.\nParsing JSON Request failed.');
                } else if(e==='timeout'){
                    alert('Request Time out.');
                } else {
                    alert("kk");
                }
            }
        });
        $('#pf_save').attr('disabled',false);
        return false;
    });

    let fieldHTML =
        '                                    <div class="text-left" >\n' +
        '                                        <div class="form-group " >\n' +
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

    $(document).on('click', '#add', function () {
        $('#ach_new').append(fieldHTML);
        $('#ach_new').append()
    });

    $(document).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
        // x--; //Decrement field counter
    });

});
