<div x-data="{ open: true }" class="flex">

    <div :class="open ? 'w-64' : 'w-0'"
        class="bg-gray-800 text-white fixed inset-0 h-full overflow-y-auto transition-all duration-300 z-50 py-3">
        <div class="h-full flex flex-col justify-between">
            <div class="flex-1">
                <div class="flex items-center justify-between mb-6 px-4">
                    <h1 class="text-xl font-bold text-white py-3">Event Management</h1>

                    <button @click="open = !open" class="text-gray-400 focus:outline-none">
                        <i :class="open ? 'fas fa-times' : 'fas fa-bars'"></i>
                    </button>
                </div>
                <nav>
                    <a href="#" class="flex items-center py-2 px-4 rounded hover:bg-gray-700 text-white">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>
                    <a href="#" class="flex items-center py-2 px-4 rounded hover:bg-gray-700 text-white">
                        <i class="fas fa-calendar-alt mr-2"></i> Events
                    </a>

                    <a href="#" class="flex items-center py-2 px-4 rounded hover:bg-gray-700 text-white">
                        <i class="fas fa-cog mr-2"></i> Configuração
                    </a>
                </nav>
            </div>
            <div class="mt-6">
                <a href="#" class="flex items-center py-2 px-4 text-gray-400 hover:text-white">
                    <i class="fas fa-question-circle mr-2"></i> Support
                </a>
                <a href="#" class="flex items-center py-2 px-4 text-gray-400 hover:text-white">
                    <i class="fas fa-sync-alt mr-2"></i> Chat
                </a>
                <div class="mt-4 flex items-center py-3 px-4 bg-gray-700 rounded-lg">
                    <img src="/images/user.jpg" alt="User" class="w-10 h-10 rounded-full mr-3">
                    <div>
                        <p class="text-sm font-semibold text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                    </div>
                    <button class="ml-auto text-gray-400">&#9662;</button>
                </div>
            </div>
        </div>
    </div>


    <div class="flex-1 ml-0 md:ml-64">

        <button @click="open = !open" class="md:hidden p-4 text-white bg-gray-800 fixed top-4 left-4 z-50">
            <i :class="open ? 'fas fa-times' : 'fas fa-bars'"></i>
        </button>
    </div>
</div>
