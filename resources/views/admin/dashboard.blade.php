@extends('layout')

@section('content')
<div class="min-h-screen bg-gray-100 p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Panel del Administrador</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <a href="{{ route('admin.denuncias.lista') }}" class="bg-white p-6 rounded-lg shadow hover:bg-blue-100 transition">
            <h2 class="text-xl font-semibold mb-2 text-gray-700"> Ver Denuncias</h2>
            <p class="text-gray-500">Consulta y gestiona todas las denuncias recibidas.</p>
        </a>

        <a href="{{ route('admin.chat.lista') }}" class="bg-white p-6 rounded-lg shadow hover:bg-green-100 transition">
            <h2 class="text-xl font-semibold mb-2 text-gray-700"> Ver Chats</h2>
            <p class="text-gray-500">Revisa y responde los mensajes de los usuarios.</p>
        </a>

        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2 text-gray-700"> Estadísticas</h2>
            <p class="text-gray-500"> Gráficos y métricas generales.</p>
        </div>
    </div>
</div>
@endsection
