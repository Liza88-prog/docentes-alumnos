@extends('layouts.app')

@section('title', 'Editar Perfil')

@section('content')
<div class="w-full max-w-md mx-auto mt-8 bg-white rounded-3xl shadow-2xl p-8 md:p-10">
    <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Editar Perfil</h2>
    <p class="text-center text-gray-500 mb-6">Actualiza tu información personal</p>

    @if (session('success'))
        <div class="mb-4 text-sm text-green-600 bg-green-100 p-3 rounded-xl border border-green-200">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" required class="mt-1 w-full px-4 py-2 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm text-gray-700 placeholder-gray-400 @error('name') border-red-500 @enderror" value="{{ old('name', $user->name) }}">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" required class="mt-1 w-full px-4 py-2 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm text-gray-700 placeholder-gray-400 @error('email') border-red-500 @enderror" value="{{ old('email', $user->email) }}">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <hr class="border-t border-gray-200 my-6">
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Nueva Contraseña</label>
            <input type="password" name="password" id="password" class="mt-1 w-full px-4 py-2 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm text-gray-700 placeholder-gray-400 @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Nueva Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 w-full px-4 py-2 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm text-gray-700 placeholder-gray-400">
        </div>
        
        <hr class="border-t border-gray-200 my-6">
        
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono (opcional)</label>
            <input type="text" name="phone" id="phone" class="mt-1 w-full px-4 py-2 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm text-gray-700 placeholder-gray-400 @error('phone') border-red-500 @enderror" value="{{ old('phone', $user->phone) }}">
            @error('phone')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="professional_url" class="block text-sm font-medium text-gray-700">URL Profesional (opcional)</label>
            <input type="url" name="professional_url" id="professional_url" class="mt-1 w-full px-4 py-2 rounded-xl border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm text-gray-700 placeholder-gray-400 @error('professional_url') border-red-500 @enderror" value="{{ old('professional_url', $user->professional_url) }}">
            @error('professional_url')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end space-x-4 pt-4">
            <button type="submit" class="w-auto py-3 px-6 bg-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:bg-indigo-700 transition duration-300">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection