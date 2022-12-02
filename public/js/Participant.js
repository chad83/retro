
function createParticipantHooks()
{
    setInterval(function(){
        if(sessionKey === "" || participantKey === "") {
            return false;
        }

        updateSessionState();

        // If the session is flagged as ready, forward the user.
        if (sessionState === "filling") {
            $("#session_waiting_fieldset").addClass("hidden");
            $("#session_ready_fieldset").removeClass("hidden");
        }

    }, refreshTimeout);
}

function rateSession()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    let formData = {
        participant_key: $("#participant_key").val(),
        session_rating: $("#session_rating").val()
    };

    $.ajax({
        type: "POST",
        url: apiPath + "participant/rate",
        data: formData,
        dataType: "json",
        success: function (data) {
        },
        error: function () {
            console.log("Error saving session rating");
        }
    });
}

$(document).ready(function($){

    $("#go_to_board").click(function(){
        window.location.href = "/session/" + sessionKey + "/" + participantKey;
    });

    createParticipantHooks();
});
