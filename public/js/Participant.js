


$(document).ready(function($){

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

    $("#go_to_board").click(function(){
        window.location.href = "/session/" + sessionKey + "/" + participantKey;
    });

    createParticipantHooks();
});
