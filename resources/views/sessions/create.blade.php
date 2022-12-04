@include('components.header')

<div class="head-title">Retro</div>

<fieldset class="form-container">
    <legend>Create a New Session</legend>
    <div class="two-columns-row">
        <div class="two-columns-cell left"><label for="session_name">Session Name</label></div>
        <div class="two-columns-cell right"><input id="session_name" placeholder="Session Name" /></div>
    </div>
    <div class="full-row right"><input id="create_session_button" type="button" value="Create Session"></div>
</fieldset>

@include('participants.createparticipant', ['contained' => 1])

<fieldset class="form-container">
    <legend>Launch Session</legend>
    <div class="two-columns-row">
        <div class="two-columns-cell left">Session Link <span id="copy_session_link" class="copy-link"><&nbsp;Copy&nbsp;Link&nbsp;></span></div>
        <div id="session_link" class="two-columns-cell right">[ &nbsp; Not yet created &nbsp; ]</div>
    </div>
    <div class="full-row right"><input type="button" id="launch_session" value="Launch Session"></div>
</fieldset>

@include('participants.currentparticipants')

@include('components.footer')
