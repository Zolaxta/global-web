<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GamePortal - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        gaming: {
                            900: '#1a1a2e',
                            800: '#16213e',
                            700: '#0f3460',
                            600: '#e94560',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gaming-900 flex items-center justify-center min-h-screen font-sans">
    <div class="w-full max-w-md bg-gaming-800 p-8 rounded-xl shadow-2xl border border-gaming-700">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gaming-600 tracking-wider">GAMEPORTAL</h1>
            <p class="text-gray-400 mt-2">Ingresa a tu cuenta para continuar</p>
        </div>

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600 focus:border-transparent placeholder-gray-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Contraseña</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 bg-gaming-900 border border-gaming-600 rounded text-white focus:outline-none focus:ring-2 focus:ring-gaming-600 focus:border-transparent placeholder-gray-500">
            </div>

            <button type="submit" 
                class="w-full bg-gaming-600 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-200 transform hover:scale-105 shadow-lg">
                INICIAR SESIÓN
            </button>
        </form>
        
        <div class="mt-6 text-center text-sm">
            <p class="text-gray-500">¿No tienes cuenta? <span class="text-gaming-600 cursor-pointer hover:underline">Regístrate</span> (Próximamente)</p>
        </div>
    </div>
</body>
</html>
