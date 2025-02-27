<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-white text-gray-900 flex flex-col min-h-screen">

    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-2xl font-bold text-[#FF2D20]">Event Management</h1>

            @if (Route::has('login'))
                <nav class="flex space-x-4">
                    @auth
                        @if (Gate::check('isAdmin'))
                            <a href="{{ url('admin/') }}" class="text-blue-600 hover:underline">
                                <i class="fas fa-user-shield"></i> Admin Panel
                            </a>
                        @else
                            <a href="{{ url('participant/inscricoes') }}" class="text-blue-600 hover:underline">
                                <i class="fas fa-user"></i> User Panel
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 rounded-md text-gray-800 border border-gray-300 transition hover:bg-gray-100">
                            <i class="fas fa-sign-in-alt"></i> Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-4 py-2 rounded-md text-gray-800 border border-gray-300 transition hover:bg-gray-100">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </div>
    </header>

    <main class="flex-1 flex flex-col items-center justify-center text-center py-10">
        <h2 class="text-3xl font-semibold mb-6">Bem-vindo ao Event Management</h2>
        <img src="https://theappideas.com/wp-content/uploads/2024/07/Event-Planner-and-Management-Website-Solutions.png"
            alt=" Image" class="w-auto h-[634px] rounded-lg shadow-lg">
        <p class="mt-4 text-gray-600">Gerencie seus eventos com facilidade e eficiência.</p>
    </main>


    <footer class="bg-white border-t border-gray-200 py-8 w-full">
        <div class="container mx-auto flex flex-wrap justify-between items-center px-6 text-gray-600 text-sm">


            <div class="mb-4 md:mb-0">
                <h3 class="text-lg font-semibold text-gray-800">Links Rápidos</h3>
                <ul class="mt-2 space-y-1">
                    <li><a href="#" class="hover:text-gray-900">Início</a></li>
                    <li><a href="#" class="hover:text-gray-900">Sobre</a></li>
                    <li><a href="#" class="hover:text-gray-900">Contato</a></li>
                </ul>
            </div>


            <div class="mb-4 md:mb-0">
                <h3 class="text-lg font-semibold text-gray-800">Siga-nos</h3>
                <div class="flex space-x-4 mt-2">
                    <a href="#" class="hover:text-blue-500"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="hover:text-blue-400"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="hover:text-pink-500"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="hover:text-red-600"><i class="fab fa-youtube fa-lg"></i></a>
                </div>
            </div>


            <div>
                <h3 class="text-lg font-semibold text-gray-800">Contato</h3>
                <p class="mt-2">contato@eventmanagement.com</p>
                <p>+55 11 99999-9999</p>
            </div>

        </div>

        <div class="mt-6 text-center text-gray-500 text-xs">
            &copy; 2025 Event Management. Todos os direitos reservados.
        </div>
    </footer>

</body>

</html>
