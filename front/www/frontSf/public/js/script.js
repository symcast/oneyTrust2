$(document).ready(function () {

    $("#submit-btn").click(function(e){

        e.preventDefault();

        let $_this = $(this);

        $_this.attr("disabled", true);

        //RAZ
        $('.text-error').html('');
        $('#distance').hide();

        let $form = $('#calculate_form');

        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: $form.serialize(),
            dataType: 'json',
            success: function(data, statut){ // success est toujours en place, bien sûr !
                $_this.attr("disabled", false);
                if(data.result == 'ok') {
                    $("span", "#distance").html(data.distance);
                    $("#distance").show();
                } else {
                    Object.keys(data.errors).forEach(key => {
                        let value = data.errors[key];
                        $("#"+key+"_error").html(value).show();

                    });
                }
            },
        });
    });
});