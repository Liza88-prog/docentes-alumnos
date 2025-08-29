<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-r from-blue-500 via-blue-400 to-blue-500 font-sans">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white shadow-2xl rounded-tr-3xl rounded-br-3xl flex flex-col min-h-screen">
            <div class="p-6 font-bold text-xl text-gray-800 border-b border-gray-200">
                Gestión Docentes
            </div>
            <nav class="flex-1 mt-6">
                <a href="{{ route('dashboard') }}" class="block py-3 px-6 text-gray-600 hover:bg-gray-100 transition-colors duration-200">
                    Inicio
                </a>
            </nav>
            <div class="p-6">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-center py-3 px-6 bg-red-500 text-white font-semibold rounded-xl shadow-lg hover:bg-red-600 transition duration-300">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>