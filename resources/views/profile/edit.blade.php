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

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-5" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="flex flex-col items-center mb-6">
            <div class="relative w-24 h-24 mb-3 group">
                <label for="photo_path" class="cursor-pointer">
                    <img id="avatar-preview" 
                        src="{{ $user->photo_path ? asset($user->photo_path) : 'https://www.gravatar.com/avatar/' . md5($user->email) . '?d=retro&s=150' }}" 
                        alt="Foto de perfil" 
                        class="w-full h-full rounded-full object-cover shadow-md border-4 border-indigo-200 transition-all duration-300 group-hover:scale-105 group-hover:border-indigo-400">
                    <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 
                                113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                </label>
            </div>

            <input type="file" name="photo_path" id="photo_path" class="hidden">
            @error('photo_path')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
            @enderror
            <p class="mt-2 text-sm text-gray-500">Haz clic en la imagen para cambiarla</p>

            <div id="new-photo-preview-container" class="mt-4 hidden text-center">
                <p class="text-sm text-gray-600 mb-2">Nueva foto seleccionada:</p>
                <div class="relative inline-block">
                    <img id="new-photo-preview" src="#" alt="Vista previa de la nueva foto" 
                        class="w-16 h-16 rounded-full object-cover border-2 border-gray-300 shadow">
                    <button type="button" id="remove-new-photo" 
                            class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center shadow hover:bg-red-700 transition">
                        ×
                    </button>
                </div>
            </div>
        </div>

        
        <hr class="border-t border-gray-200 my-6">

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

<script>
    document.getElementById('photo_path').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('new-photo-preview-container').classList.remove('hidden');
                document.getElementById('new-photo-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('new-photo-preview-container').classList.add('hidden');
        }
    });
</script>
@endsection