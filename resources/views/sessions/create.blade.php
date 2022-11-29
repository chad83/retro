@include('components.header')

<div class="head-title">Retro</div>

<fieldset class="form-container">
    <legend>Create a New Form</legend>
    <input type="hidden" id="session_key" value="" />
    <div class="two-columns-row">
        <div class="two-columns-cell left"><label for="session_name">Session Name</label></div>
        <div class="two-columns-cell right"><input id="session_name" placeholder="Session Name" /></div>
    </div>
    <div class="full-row right"><input id="create_session_button" type="button" value="Create Session"></div>
</fieldset>

@include('sessions.createparticipant', ['contained' => 1])

<fieldset class="form-container">
    <legend>Launch Session</legend>
    <div class="two-columns-row">
        <div class="two-columns-cell left">Session Link</div>
        <div id="session_link" class="two-columns-cell right">[   Not yet created   ]</div>
    </div>
    <div class="two-columns-row">
        <div class="two-columns-cell left">Participants</div>
        <div class="two-columns-cell right">
            <ul id="participants_list"></ul>
        </div>
    </div>
    <div class="full-row right"><input type="button" value="Launch Session"></div>
</fieldset>

@include('components.footer')



