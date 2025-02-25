{{-- resources/views/errors/403.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>403 Unauthorized</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}"> <!-- Include your styles -->
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="bg-white border border-gray-300 rounded-lg shadow p-8">
            <h1 class="text-4xl font-semibold text-red-500">403</h1>
            <p class="text-xl text-gray-600">Você não ta autorizado.</p>
            <a href="{{ route('home') }}" class="text-blue-500 mt-4">Voltar</a>
        </div>
    </div>
</body>

</html>
