<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-r from-blue-500 via-blue-400 to-blue-500 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 md:p-10">
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Bienvenido de nuevo</h2>
        <p class="text-center text-gray-500 mb-6">Ingresa a tu cuenta para continuar</p>

        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600 bg-red-100 p-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico</label>
                <input type="email" name="email" id="email" required
                       class="mt-1 w-full px-4 py-2 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm text-gray-700 placeholder-gray-400">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" required
                       class="mt-1 w-full px-4 py-2 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm text-gray-700 placeholder-gray-400">
            </div>

            <div class="flex items-center justify-between text-sm text-gray-600">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <span>Recuérdame</span>
                </label>
                <a href="#" class="hover:underline text-indigo-600">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit"
                    class="w-full py-3 bg-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:bg-indigo-700 transition duration-300">
                Iniciar sesión
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            ¿No tienes cuenta?
            <a href="{{ route('register') }}" class="text-indigo-600 font-medium hover:underline">Regístrate aquí</a>
        </p>
    </div>

</body>
</html>