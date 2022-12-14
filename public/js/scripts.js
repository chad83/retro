const apiPath = "http://165.227.155.99:8080/api/v1/";
const refreshTimeout = 7000;
let illegalSpecialCharacters = [51]; // #
let illegalCharacters = []; // Any illegal character that don't require special shift-key event.
let sessionStates = ["created", "ready", "filling", "revealed"];


let sessionKey = "";
let sessionState = "";
let participantKey = "";


/**
 * Gets the state of the current session.
 */
function updateSessionState()
{
    if(sessionKey === "") {
        return false;
    }

    $.ajax({
        type: "GET",
        url: apiPath + "session/" + sessionKey + "/state",
        dataType: "json",
        success: function (data) {
            sessionState = data.state;

            if (data.state === "revealed") {
                $("#session_revealed_container").show(800);
            }
        },
        error: function () {
            console.log("Error getting session state");
        }
    });
}

jQuery(document).ready(function($){
    let vci = $("#vci_input");
    let vciHelper = $("#vci_helper");
    let postItColors = ["#ff7eb9", "#7afcff", "#feff9c"];

    /**
     * Reloads global variables from hidden fields.
     */
    function updateReadHiddenInputs()
    {
        sessionKey = $("#session_key").val();
        sessionState = $("#session_state").val();
        participantKey = $("#participant_key").val();
    }

    function setSessionState(sessionState)
    {
        if(!sessionStates.includes(sessionState)) {
            return false;
        }

        let formData = {
            sessionKey: $("#session_key").val(),
            state: sessionState
        };

        $.ajax({
            type: "POST",
            url: apiPath + "session/state",
            data: formData,
            dataType: "json",
            success: function (data) {
                $("#session_state").val(sessionState);
                updateReadHiddenInputs();
            },
            error: function () {
                console.log("Error changing session state");
            }
        });
    }

    $("#create_participant_button").click(function(){
        let sessionKey = $("#session_name").val();

        let formData = {
            sessionKey: $("#session_key").val(),
            name: $("#participant_name").val(),
            color: $("#participant_color").val(),
        };

        $.ajax({
            type: "POST",
            url: apiPath + "participant",
            data: formData,
            dataType: "json",
            success: function (participant) {
                $("#participant_key").val(participant.key);
                updateReadHiddenInputs();

                $("#create_participant_section").addClass("hidden");
                $("#session_waiting_fieldset").removeClass("hidden");
            },
            error: function (data) {
                console.log("Error Creating Participant");
            }
        });
    });

    let tempCurrentParticipants = [];
    function getParticipants()
    {
        if(sessionKey === "") {
            return false;
        }

        $.ajax({
            type: "GET",
            url: apiPath + "session/" + sessionKey + "/participants",
            // data: formData,
            dataType: "json",
            success: function (session) {
                session.participants.forEach(function(participant) {
                    // If there are new participants, add them to the participants list and display them.
                    if(!tempCurrentParticipants.includes(participant.key)) {
                        tempCurrentParticipants.push(participant.key)
                        $("#participants_list").append("<li>" + participant.name + "</li>");
                    }
                });
            },
            error: function (session) {
                console.log("ERROR");
            }
        });
    }

    function executeCommand(category, textLine)
    {
        // Get the text from the text line.
        let text = textLine.substring(textLine.indexOf(" ")).trim();

        if (category === "went well" || category === "to improve") {
            savePost(category, text);
        } else if(category === "rate") {
            saveRating(text);
        } else if(category === "session state" && sessionStates.includes(text)) {
            setSessionState(text);
        }

        return false;
    }

    function savePost(category, text)
    {
        let formData = {
            sessionKey: $("#session_key").val(),
            participantKey: $("#participant_key").val(),
            category: category,
            text: text
        };

        $.ajax({
            type: "POST",
            url: apiPath + "post",
            data: formData,
            dataType: "json",
            success: function (data) {
                addPostIt(data);
            },
            error: function () {
                console.log("Error saving post");
            }
        });
    }

    function animateValueChange(element, newValue, setSize = 16, flashSize = 18)
    {
        $(element).animate({"font-size": flashSize}, 800, function(){
            $(element).html(newValue).animate({"font-size": setSize}, 800);
        });
    }

    function saveRating(rating)
    {
        rating = parseInt(rating);
        if (rating < 0 || rating > 5) {
            return false;
        }

        let formData = {
            participant_key: $("#participant_key").val(),
            session_rating: rating
        };

        $.ajax({
            type: "POST",
            url: apiPath + "participant/rate",
            data: formData,
            dataType: "json",
            success: function () {
                animateValueChange($("#rating_field"), rating);
            },
            error: function () {
                console.log("Error saving session rating");
            }
        });
    }

    function addPostIt(post)
    {
        let randomColor = postItColors[Math.floor(Math.random() * postItColors.length)];

        $("#post_it_template")
            .clone()
            .css("background-color", randomColor)
            .removeClass("template")
            .attr("id", "post_it_" + post.key)
            .attr("post-key", post.key)
            .text(post.category + ": " + post.text)
            .appendTo($("#post_it_container"));
    }

    function updateHelper(text, replaceLastHint = false)
    {
        let helperText = vciHelper.val();
        let lineStart = 0; // Character index.

        if (helperText.indexOf("\n")) {
            lineStart = helperText.lastIndexOf("\n") + 1;
        }

        vciHelper.val(helperText.substring(0, lineStart) + text);
    }

    function getParticipantPosts()
    {
        if (sessionKey === "" || participantKey === "") {
            return false;
        }

        $.ajax({
            type: "GET",
            url: apiPath + "post/getparticipantposts/" + sessionKey + "/" + participantKey,
            dataType: "json",
            success: function (data) {

                data.forEach(function(post){
                    addPostIt(post);
                });

                vci.focus();
            },
            error: function (data) {
                console.log("ERROR");
            }
        });
    }

    $("#create_session_button").click(function(){
        let sessionName = $("#session_name").val();

        if (sessionName.length < 3) {
            return false;
        }

        let formData = {
            name: sessionName
        };

        $.ajax({
            type: "POST",
            url: apiPath + "session",
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
        setSessionState("filling");
    });

    /**
     * Copies the link to the clipboard.
     */
    $("#copy_session_link").click(function(){
        navigator.clipboard.writeText($("#session_link>a").html()).then();
    });

    $("#go_to_results").click(function(){
        window.location.href = "/session/" + sessionKey + "/results";
    });

    function getTextLine(text)
    {
        let textLine = text.substring(text.lastIndexOf("#"));
        return textLine.trim();
    }

    /**
     * Extracts the current command entered by the user.
     *
     * @param textLine
     *
     * @returns {string}
     */
    function getCurrentCommand(textLine)
    {
        // Remove the #
        textLine = textLine.substring(1).trim();

        let commandKey = "";
        let argument = "";

        // Extract the command.
        if (textLine.indexOf(" ") > -1) {
            commandKey = textLine.substring(0, textLine.indexOf(" "));
        } else {
            commandKey = textLine;
        }

        // Extract the argument.
        if (textLine.indexOf(" ") > -1) {
            argument = textLine.substring(textLine.indexOf(" ") + 1);
        }


        if (commandKey === "1") {
            return "went well";
        } else if (commandKey === "2") {
            return "to improve";
        } else if (commandKey === "rate") {

            // Check that the argument given is between 1 and 5.
            if (argument !== "") {
                if (!parseInt(argument) || parseInt(argument) > 5) {
                    return "1 -> 5";
                }
            }

            return "rate";
        } else if (commandKey === "session") {
            return "session state";
        }

        return "bad command";
    }

    // Makes sure the cursor is always at the end of the CLI view.
    function resetCursorPosition()
    {
        let temp = vci.val();
        vci.val("");
        vci.val(temp);
    }

    vci.focus(function () {
        resetCursorPosition();
    });

    vci.click(function () {
        resetCursorPosition();
    });

    vci.keyup(function (e) {
        let text = $(this).val();
        let helperText = vciHelper.val();
        let textLine = getTextLine(text);
        let currentCommand = getCurrentCommand(textLine);

        // Make sure every line starts with #
        if (text.indexOf("\n")) {
            let lastEnterKeyPosition = text.lastIndexOf("\n");

            if (text.substring(lastEnterKeyPosition + 1, lastEnterKeyPosition + 2) !== "#") {
                $(this).val(
                    text.substring(0, lastEnterKeyPosition + 2) + "#" + text.substring(lastEnterKeyPosition + 2)
                );
            }
        } else if (text === "") {
            $(this).val("#");
        }

        updateHelper(currentCommand);

        // Enter key press.
        if (e.which === 13) {
            // resetCursorPosition();
            $(this).val(text + "#");

            // Skip a line in the helper.
            vciHelper.val(helperText + "\n");

            // Attempt to execute the command.
            executeCommand(currentCommand, textLine);
        }

        // Illegal key press for characters with shift key (special characters).
        if (illegalSpecialCharacters.includes(e.which) && e.shiftKey) {
            $(this).val(text.substring(0, text.length - 1));
        }

        // Illegal key press.
        if (illegalCharacters.includes(e.which) && !e.shiftKey) {
            $(this).val(text.substring(0, text.length - 1));
        }

    });

    vci.keydown(function (e) {
        let text = $(this).val();
        let helperText = vciHelper.val();

        // Always push the cursor to the end of the line before adding a new line.
        if (e.which === 13) {
            resetCursorPosition();
        }

        // // Backspace key press.
        // if (e.which === 8) {
        //     // e.preventDefault();
        //     if(text.substring(text.length - 1) === "#") {
        //         $(this).val(text + "#");
        //     }
        // }

        // Prevent the left-arrow click if the cursor is at the start of the line.
        if (e.which === 37 && $("#vci_input").prop("selectionStart") - text.lastIndexOf("#") <= 1) {
            e.preventDefault();
        }
        // Prevent the arrow up key.
        if (e.which === 38) {
            e.preventDefault();
        }
        // On Ctrl+C, skip a line (like in a CLI).
        if (e.which === 67 && e.ctrlKey) {
            e.preventDefault();
            $(this).val(text + "\n");
        }
    });

    function createPageHooks()
    {
        let currentPage = $("#page").val();

        if(currentPage === "createSession" || currentPage === "filling") {
            setInterval(function () {
                getParticipants();
                updateSessionState();
            }, refreshTimeout);
        }
    }

    updateReadHiddenInputs();
    vci.focus();
    getParticipantPosts(); // --TBC-- should it always run?

    // Execute all timed methods.
    createPageHooks();

});
