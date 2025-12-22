<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-800 selection:bg-indigo-500 selection:text-white">
    <div class="flex flex-col min-h-screen items-center justify-center">
        @yield('content')
    </div>
</body>
</html>
