<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="icon" type="image/x-icon" href="{{ url('favicon.ico') }}">
        <title>KeyLearn</title>
    </head>
    <body>
        <div id="app">
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>