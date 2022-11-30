<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>RETRO</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/scripts.js') }}" defer></script>
    <?php if (isset($showCreateJs)) { ?><script src="{{ asset('js/SessionCreate.js') }}"></script><?php } ?>
    <?php if (isset($showParticipantJs)) { ?><script src="{{ asset('js/Participant.js') }}"></script><?php } ?>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">

<input type="hidden" id="session_key" value="{{ $sessionKey ?? "" }}" />
<input type="hidden" id="session_state" value="{{ $sessionState ?? "" }}" />
<input type="hidden" id="participant_key" value="{{ $participantKey ?? "" }}" />
