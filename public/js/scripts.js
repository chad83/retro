const apiPath = "/api/v1/";
const refreshTimeout = 5000;


jQuery(document).ready(function($){

    let key = jQuery("#key").val();
    let vci = $("#vci_input");
    let vciHelper = $("#vci_helper");




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

    function getTextLine(text)
    {
        let textLine = text.substring(text.lastIndexOf("#"));
        return textLine.trim();
    }

    function getCurrentCommand(textLine)
    {
        // Remove the #
        textLine = textLine.substring(1).trim();

        let commandKey = textLine.substring(0, 1);

        if (commandKey == 1) {
            return "went well";
        } else if (commandKey == 2) {
            return "to improve";
        } else {
            return "bad command";
        }
    }

    function updateHelper(command)
    {
        let helperText = vciHelper.val();
        let lineStart = 0; // Character index.

        if (helperText.indexOf("\n")) {
            lineStart = helperText.lastIndexOf("\n") + 1;
        }

        $("#vci_helper").val(helperText.substring(0, lineStart) + command);
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
        let helperText = $("#vci_helper").val();
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
            $("#vci_helper").val(helperText + "\n");
        }
    });

    // Always push the cursor to the end of the line before adding a new line.
    vci.keydown(function (e) {
        if (e.which === 13) {
            resetCursorPosition();
        }
    });



    vci.focus();

});
