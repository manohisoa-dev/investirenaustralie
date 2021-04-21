$(document).ready(function(){
    $('.inputGroupFile').on('change',function(){
        var file_name = ($(this).val()).split('\\')[2];

        $('.inputGroupFileName').text(file_name);
    });

    $('.inputGroupFile02').on('change',function(){
        var file_name = ($(this).val()).split('\\')[2];

        $('.inputGroupFileName02').text(file_name);
    });
});