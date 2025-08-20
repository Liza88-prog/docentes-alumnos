@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<h1 class="text-2xl font-bold mb-6">Dashboard de Gestión de Docentes</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-bold text-lg">Total Docentes</h2>
        <p class="text-3xl mt-4">{{ $teachersCount ?? 0 }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-bold text-lg">Docentes Activos</h2>
        <p class="text-3xl mt-4">{{ $activeTeachers ?? 0 }}</p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h2 class="font-bold text-lg">Docentes Inactivos</h2>
        <p class="text-3xl mt-4">{{ $inactiveTeachers ?? 0 }}</p>
    </div>
</div>
@endsection