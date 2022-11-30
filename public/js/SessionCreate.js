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

    function applyCreatedSession(session)
    {
        $("#create_participant_section").removeClass("hidden");

        let sessionLink = window.location.origin + "/participant/" + session['key'] + "/create/";

        $("#session_link").html("<a href=\"" + sessionLink + "\">" + sessionLink + "</a>");
        $("#session_key").val(session['key']);

        updateReadHiddenInputs();
    }

    $("#launch_session").click(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        let formData = {
            sessionKey: $("#session_key").val(),
            state: "filling"
        };

        $.ajax({
            type: "POST",
            url: apiPath + "session/state",
            data: formData,
            dataType: "json",
            success: function (data) {
                $("#session_state").val("filling");
                updateReadHiddenInputs();
            },
            error: function () {
                console.log("Error changing session state");
            }
        });
    });

    /**
     * Copies the link to the clipboard.
     */
    $("#copy_session_link").click(function(){
        navigator.clipboard.writeText($("#session_link>a").html()).then();
    });

    function createPageHooks()
    {
        setInterval(getParticipants, refreshTimeout);
    }

    // Execute all timed methods.
    createPageHooks();

});
