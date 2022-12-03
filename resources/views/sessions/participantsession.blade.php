@include('components.header')

<div class="participant-details">
    <span>{{ $participant->name }}</span>
</div>

<div>
    <ul>
        <li>
            Type <span class="code">1</span>, space, your comment then <span class="code">enter</span> to create a "went well" card
            <br />
            ie: <span class="vci-code-example">1 I like my office chair</span>
        </li>

        <li>
            Type <span class="code">2</span>, space, your comment then <span class="code">enter</span> to create a "could be better" card
            <br />
            ie: <span class="vci-code-example">2 it's too noisy at the office</span>
        </li>

        <li>
            Type <span class="code">rate</span>, space, a rating between 1 and 5 followed by <span class="code">enter</span> to rate the last sprint
            <br />
            ie: <span class="vci-code-example">rate 5</span>
        </li>
    </ul>
</div>

<fieldset id="session_revealed_container" class="form-container hidden">
    <legend>Session Ended</legend>
    <div class="full-row">This session is now in the "reveal" stage. Click on the button below to go to see the results</div>
    <div class="full-row right"><input id="go_to_results" type="button" value="View Results"></div>
</fieldset>


<div class="vci_container">
    <div class="vci">
        <textarea id="vci_input" class="vci-input">#</textarea>
        <textarea id="vci_helper" class="vci-helper" readonly></textarea>
    </div>
</div>

<div class="current-rating">
    <span class="title">Your Session Rating:</span>
    <span id="rating_field" class="value">{{ $participant->session_rating }}</span>
</div>

<!-- Template to be copied -->
<div id="post_it_container" class="post-its-container">
    <div id="post_it_template" class="post-it template">
        <div class="header">X</div>
        <div class="text">EXAMPLE TEXT</div>
    </div>
</div>

@include('participants.currentParticipants')


@include('components.footer')



