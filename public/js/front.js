$(document).ready(function () {
    // Jscript section 3 home
    $('.sec-three button').click(function(e){
        var val = $(this).val();
        var footer = "<button type='button' class='btn btn-default' data-dismiss='modal' aria-label='Close'>Fermer</button>";
        var body = "";

        $.get(
            "home/modal/step/"+val,
            function (data) {
                var prgphe = data.split('.');
                // get each paragraph
                for (var i = 0; i < prgphe.length; i++) { body+= '<p>'+prgphe[i]+'</p>' };

                return $('#secThreeModal .modal-content').html(
                '<div class="modal-body">'+body+'</div>'+                
                '<div class="modal-footer">'+footer+'</div>');
            }
        );
    })
});