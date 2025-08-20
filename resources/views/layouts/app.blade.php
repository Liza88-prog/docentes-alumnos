<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - @yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-6 font-bold text-xl border-b">Gestión Docentes</div>
            <nav class="mt-6">
                <a href="{{ route('dashboard') }}" class="block py-2 px-6 hover:bg-gray-200">Inicio</a>
                <a href="{{ route('teachers.index') }}" class="block py-2 px-6 hover:bg-gray-200">Docentes</a>
                <a href="{{ route('teachers.create') }}" class="block py-2 px-6 hover:bg-gray-200">Agregar Docente</a>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>