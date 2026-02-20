<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GamePortal - @yield('title', 'Inicio')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        gaming: { 900: '#1a1a2e', 800: '#16213e', 700: '#0f3460', 600: '#e94560' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gaming-900 text-gray-100 min-h-screen flex flex-col font-sans">
    
    <nav class="bg-gaming-800 border-b border-gaming-700 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-gaming-600 tracking-wider hover:text-white transition">GAMEPORTAL</a>
                    
                    @auth
                        <div class="hidden md:block ml-10 space-x-4">
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:bg-gaming-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-gaming-700 text-white' : '' }}">Usuarios</a>
                                
                                <a href="{{ route('admin.rewards.index') }}" class="text-gray-300 hover:bg-gaming-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('admin.rewards.index') ? 'bg-gaming-700 text-white' : '' }}">Premios</a>
                            @else
                                <a href="{{ route('rewards.catalog') }}" class="text-gray-300 hover:bg-gaming-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('rewards.catalog') ? 'bg-gaming-700 text-white' : '' }}">Catálogo</a>
                                
                                <a href="{{ route('user.inventory') }}" class="text-gray-300 hover:bg-gaming-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('user.inventory') ? 'bg-gaming-700 text-white' : '' }}">Mis Premios</a>
                            @endif
                        </div>
                    @endauth
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="text-right mr-4">
                            <div class="text-sm font-medium text-white">{{ auth()->user()->name }}</div>
                            <div class="text-xs text-gaming-600 font-bold">PTS: {{ number_format(auth()->user()->points) }}</div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm font-medium transition">
                                Salir
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @yield('content')
    </main>

        <footer class="bg-gaming-800 border-t border-gaming-700 mt-auto">

            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

                <p class="text-center text-gray-400 text-sm">

                    &copy; {{ date('Y') }} GamePortal. Todos los derechos reservados.

                </p>

            </div>

        </footer>

    

        @if(session('reward_purchased'))

            <div id="toast-notification" class="fixed bottom-5 right-5 z-50 bg-gaming-800 border-l-4 border-green-500 p-6 rounded shadow-2xl max-w-sm transform transition-all duration-500 ease-in-out">

                <div class="flex items-start">

                    <div class="flex-shrink-0">

                        <span class="text-3xl">🎉</span>

                    </div>

                    <div class="ml-3">

                        <h3 class="text-lg font-bold text-white">¡Canje Exitoso!</h3>

                        <p class="text-sm text-gray-300 mt-1">Has adquirido: <span class="font-bold text-green-400">{{ session('reward_purchased')->name }}</span></p>

                        <p class="text-xs text-gray-400 mt-1">Coste: {{ session('reward_purchased')->point_cost }} Puntos</p>

                        <a href="{{ route('user.inventory') }}" class="mt-3 inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm font-medium transition">

                            Ver en mi Inventario

                        </a>

                    </div>

                    <button onclick="document.getElementById('toast-notification').classList.add('hidden')" class="ml-auto text-gray-400 hover:text-white">

                        &times;

                    </button>

                </div>

            </div>

            <script>

                setTimeout(function() {

                    const toast = document.getElementById('toast-notification');

                    if(toast) {

                        toast.style.opacity = '0';

                        setTimeout(() => toast.classList.add('hidden'), 500);

                    }

                }, 6000);

            </script>

        @endif

    </body>

    </html>

    