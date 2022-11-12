const apiPath = "/api/v1/";
const refreshTimeout = 5000;


jQuery(document).ready(function($){

    let key = jQuery("#key").val();


    function getParticipants()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        // e.preventDefault();
        // var formData = {
        //     // title: jQuery('#title').val(),
        //     // description: jQuery('#description').val(),
        // };

        $.ajax({
            type: "GET",
            url: apiPath + "session/" + key + "/participants",
            // data: formData,
            dataType: "json",
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log('ERROR');
            }
        });
    }

    // Get participants
    $("#btn1").click(function () {
        setInterval(getParticipants, refreshTimeout);
    });

    $("#vci_input").keyup(function (e) {
        let text = $(this).val();

        if (text.indexOf("\n")) {
            var lastEnterKeyPosition = text.lastIndexOf("\n");

            if (text.substring(lastEnterKeyPosition + 1, lastEnterKeyPosition + 2) !== "#") {
                $(this).val(
                    text.substring(0, lastEnterKeyPosition + 2) + "#" + text.substring(lastEnterKeyPosition + 2)
                );
            }
        } else if (text === "") {
            $(this).val("#");
        }

        // Enter key press.
        if (e.which === 13) {
            $(this).val(text + "#");
            console.log($(this).val());
        }
    });

});
