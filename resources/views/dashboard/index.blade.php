@extends('layouts.app')

@section('title', 'Docentes')

@section('content')
<h1 class="text-2xl font-bold mb-6">Lista de Docentes</h1>

<table class="min-w-full bg-white rounded shadow overflow-hidden">
    <thead class="bg-gray-200 text-left">
        <tr>
            <th class="py-3 px-6">Nombre</th>
            <th class="py-3 px-6">Email</th>
            <th class="py-3 px-6">Estado</th>
            <th class="py-3 px-6">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teachers as $teacher)
        <tr class="border-b">
            <td class="py-3 px-6">{{ $teacher->name }}</td>
            <td class="py-3 px-6">{{ $teacher->email }}</td>
            <td class="py-3 px-6">
                <span class="px-2 py-1 rounded text-white {{ $teacher->active ? 'bg-green-500' : 'bg-red-500' }}">
                    {{ $teacher->active ? 'Activo' : 'Inactivo' }}
                </span>
            </td>
            <td class="py-3 px-6">
                <a href="{{ route('teachers.edit', $teacher) }}" class="text-blue-500 hover:underline">Editar</a>
                <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 hover:underline ml-2" type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection