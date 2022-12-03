@include('components.header')

@php
$postItColors = ['#ff7eb9', '#7afcff', '#feff9c'];
@endphp

<fieldset class="form-container">
    <legend>Session Stats</legend>
    <div class="two-columns-row">
        <div class="two-columns-cell left"><label for="session_name">Session Name</label></div>
        <div class="two-columns-cell right">{{ $session->name }}</div>
    </div>

    <div class="two-columns-row">
        <div class="two-columns-cell left"><label for="session_name">Participants</label></div>
        <div class="two-columns-cell right">
            <ul>
                @foreach($session->participants as $participant)
                    <li>{{ $participant->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="two-columns-row">
        <div class="two-columns-cell left"><label for="session_name">Average Rating</label></div>
        <div class="two-columns-cell right">{{ $session->ratingAverage }} ({{ $session->numberOfVoters }} voted)</div>
    </div>
</fieldset>

<div class="results-table">
    <div class="row">
        <div class="cell header">Went Well</div>
        <div class="cell header">Can be Improved</div>
    </div>

    <div class="row">
        <div class="cell">
            @foreach($session->posts as $post)
                @if($post->category === 'went well')
                    <div class="post-it" style="background-color: {{ $postItColors[rand(0, 2)] }}">
{{--                        <div class="header">X</div>--}}
                        <div class="text">{{ $post->text }}</div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="cell bordered">
            @foreach($session->posts as $post)
                @if($post->category === 'to improve')
                    <div class="post-it" style="background-color: {{ $postItColors[rand(0, 2)] }}">
                        {{--                        <div class="header">X</div>--}}
                        <div class="text">{{ $post->text }}</div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

@include('components.footer')
