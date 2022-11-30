<?php
$addedClass = 'hidden';
if (!isset($contained)) {
    $addedClass = '';
    ?>
@include('components.header')
<?php } ?>

<fieldset id="create_participant_section" class="form-container <?= $addedClass ?>">
    <legend>Create a Participant</legend>
    <div class="two-columns-row">
        <div class="two-columns-cell left"><label for="session_name">Your Name</label></div>
        <div class="two-columns-cell right"><input id="participant_name" placeholder="Your Name" /></div>
        <div class="two-columns-cell left"><label for="session_name">Color</label></div>
        <div class="two-columns-cell right"><input id="participant_color" placeholder="Your Hex Color" /></div>
    </div>
    <div class="full-row right"><input id="create_participant_button" type="button" value="Join Session"></div>
</fieldset>

<fieldset id="session_waiting_fieldset" class="form-container hidden">
    <legend>Session Waiting</legend>
    <div class="full-row">Waiting for the session to start</div>
</fieldset>

<fieldset id="session_ready_fieldset" class="form-container hidden">
    <legend>Session Ready</legend>
    <div class="full-row right"><input id="go_to_board" type="button" value="Go to Board"></div>
</fieldset>

<?php if (!isset($contained)) { ?>
@include('components.footer')
<?php } ?>


