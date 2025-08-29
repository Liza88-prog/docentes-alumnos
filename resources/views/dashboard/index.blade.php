@extends('layouts.app')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="w-full max-w-5xl mx-auto mt-8 p-6 md:p-10 bg-white rounded-3xl shadow-2xl">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-extrabold text-gray-800">Lista de Usuarios</h1>
        <a href="{{ route('users.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-xl shadow-lg transition duration-300">
            Crear Usuario
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-sm text-green-600 bg-green-100 p-3 rounded-xl border border-green-200">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 text-sm text-red-600 bg-red-100 p-3 rounded-xl border border-red-200">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-xl overflow-hidden">
            <thead class="bg-gray-100 text-left">
                <tr class="text-gray-600">
                    <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wider">ID</th>
                    <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wider">Nombre</th>
                    <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wider">Email</th>
                    <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wider">Rol</th>
                    <th class="py-3 px-4 text-sm font-semibold uppercase tracking-wider text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                    <td class="py-3 px-4 text-sm text-gray-700">{{ $user->id }}</td>
                    <td class="py-3 px-4 text-sm text-gray-700">{{ $user->name }}</td>
                    <td class="py-3 px-4 text-sm text-gray-700">{{ $user->email }}</td>
                    <td class="py-3 px-4 text-sm text-gray-700">{{ $user->role_id }}</td>
                    <td class="py-3 px-4 text-sm text-center space-x-2">
                        <a href="{{ route('users.edit', $user) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">Editar</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('¿Estás seguro de que deseas eliminar a este usuario?');">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection