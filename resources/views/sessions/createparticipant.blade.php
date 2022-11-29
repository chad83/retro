<?php
$addedClass = 'hidden';
if (!isset($contained)) {
    $addedClass = '';
    ?>
@include('components.header')
<?php } ?>

<fieldset id="create_participant_section" class="form-container <?= $addedClass ?>">
    <input type="hidden" id="session_key" value="{{ $sessionKey ?? "" }}" />
    <input type="hidden" id="participant_key" value="" />

    <legend>Create a Participant</legend>
    <div class="two-columns-row">
        <div class="two-columns-cell left"><label for="session_name">Your Name</label></div>
        <div class="two-columns-cell right"><input id="participant_name" placeholder="Your Name" /></div>
    </div>
    <div class="full-row right"><input id="create_participant_button" type="button" value="Join Session"></div>
</fieldset>

<?php if (!isset($contained)) { ?>
@include('components.footer')
<?php } ?>


