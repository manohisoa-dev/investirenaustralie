$(document).ready(function() {
    // list view
    $('#list').click(function(event){
        event.preventDefault();
        $('.view-item').removeClass('col-lg-6');
        $('.view-item').addClass('col-lg-12');
    });

    // grid view
    $('#grid').click(function(event){
        event.preventDefault();
        $('.view-item').removeClass('col-lg-12');
        $('.view-item').addClass('col-lg-6');
    });
});