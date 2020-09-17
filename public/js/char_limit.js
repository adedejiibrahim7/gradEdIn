$(document).ready(function () {
    let max_char = 250;
    $('#bio').keyup(function(){
        let count = $('#bio').val().length;
        let rem = max_char - count;
        let str = rem + '/250';
        $('#char_count').html(str);


    });
});
