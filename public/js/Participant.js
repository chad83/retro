
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

$(document).ready(function($){

    $("#go_to_board").click(function(){
        window.location.href = "/session/" + sessionKey + "/" + participantKey;
    });

    createParticipantHooks();
});
