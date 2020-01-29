$(document).ready(function () {

    $("#submit-btn").click(function(e){

        e.preventDefault();

        let $form = $('#calculate_form');

        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
            success: function(data, statut){ // success est toujours en place, bien sûr !
                console.log('success');
            },
        });
    });

    // $('#calculate_form').submit(function(e) {
    //
    //     e.preventDefault();
    //
    //     var url = $('#calculate_form').attr('action');
    //     var formSerialize = $('#calculate_form').serialize();
    //
    //     $.post(url, formSerialize, function(response) {
    //         //your callback here
    //         alert(response);
    //     }, 'JSON');
    // });


});