<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('titulo', '')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <header class="sticky top-0 z-50 bg-blue-600 shadow-md">
        <nav class="container mx-auto flex items-center justify-between py-2 px-4">


            <span class="text-white text-2xl font-bold"></span>
            </a>
            <button class="lg:hidden text-white focus:outline-none" id="menu-toggle">
                ☰
            </button>
            <div class="hidden lg:flex items-center space-x-6" id="navbar-menu">
                <a href="{{ route('login') }}"
                    class="px-4 py-1 border border-white text-white rounded-md hover:bg-white hover:text-blue-600 transition">
                    Login
                </a>
            </div>
        </nav>
    </header>

    <div class="container mx-auto mt-6 px-4">
        @yield('main')
    </div>

    <footer class="flex justify-center mt-6 mb-3">
        <div class="text-center text-gray-700 border-t w-full py-3">

        </div>
    </footer>

    @stack('scripts')

    <script>
        document.getElementById("menu-toggle").addEventListener("click", function() {
            document.getElementById("navbar-menu").classList.toggle("hidden");
        });
    </script>
</body>

</html>
