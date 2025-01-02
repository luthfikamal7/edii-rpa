<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/logo-edii.ico') }}">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <title>Athena</title>
    <meta name="description" content="Athena">
        <meta name="keywords" content="Athena">
        <meta name="author" content="Athena">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @spladeHead
</head>

<body class="font-sans antialiased">
    @splade
</body>

</html>