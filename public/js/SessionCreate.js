jQuery(document).ready(function($){

    $("#create_session_button").click(function(){
        let sessionName = $("#session_name").val();

        if (sessionName.length < 3) {
            return false;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        let formData = {
            name: sessionName
        };

        $.ajax({
            type: "POST",
            url: apiPath + "session/",
            data: formData,
            dataType: "json",
            success: function (data) {
                applyCreatedSession(data);
            },
            error: function (data) {
                console.log("Error Creating Session");
            }
        });
    });

    $("#create_participant_button").click(function(){
        let sessionKey = $("#session_name").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        let formData = {
            name: sessionName
        };

        $.ajax({
            type: "POST",
            url: apiPath + "session/",
            data: formData,
            dataType: "json",
            success: function (data) {
                applyCreatedSession(data);
            },
            error: function (data) {
                console.log("Error Creating Session");
            }
        });
    });

    function applyCreatedSession(session)
    {
        $("#create_participant_section").removeClass("hidden");

        let sessionLink = window.location.origin + "/participant/" + session['key'] + "/create/";
        $("#session_link").html("<a href=\"" + sessionLink + "\">" + sessionLink + "</a>");
    }

});
