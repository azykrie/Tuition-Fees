<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title', 'Dashboard Flow Bite')</title>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    @yield('content')
</body>
@stack('scripts')
</html>
