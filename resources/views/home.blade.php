@extends('layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 flex flex-col items-center justify-center text-center px-6">
    <div class="bg-white/70 backdrop-blur-md shadow-xl rounded-2xl p-10 max-w-2xl border border-blue-100">
        <h1 class="text-4xl font-bold text-blue-700 mb-4">Bienvenido a la Plataforma Anti-Bullying</h1>
        <p class="text-gray-600 text-lg mb-8">
             Plataforma para prevenir, detectar y reportar casos de bullying.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('denuncias.index') }}"
               class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition">
                Denunciar Bullying
            </a>

            <a href="{{ route('chat.index') }}"
               class="px-6 py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition">
                Chat de Apoyo
            </a>

            <a href="{{ route('recursos.index') }}"
               class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-xl hover:bg-purple-700 transition">
                Recursos Educativos
            </a>
        </div>
    </div>

    <footer class="mt-12 text-gray-500 text-sm">
        &copy; {{ date('Y') }} Plataforma Anti-Bullying 
    </footer>
</div>
@endsection
