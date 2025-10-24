@extends('layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100 py-12 flex flex-col items-center">
    <div class="bg-white rounded-2xl shadow-xl p-8 max-w-4xl w-full">
        <h2 class="text-3xl font-bold text-green-700 mb-6 text-center">Recursos Educativos</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-6 bg-green-50 border-l-4 border-green-500 rounded-lg">
                <h3 class="text-lg font-semibold text-green-700 mb-2">Guía para estudiantes</h3>
                <p class="text-gray-600 text-sm">Aprende a identificar y actuar frente a casos de acoso escolar.</p>
                <a href="#" class="text-green-600 font-medium hover:underline mt-2 inline-block">Leer más →</a>
            </div>

            <div class="p-6 bg-green-50 border-l-4 border-green-500 rounded-lg">
                <h3 class="text-lg font-semibold text-green-700 mb-2">Consejos para padres</h3>
                <p class="text-gray-600 text-sm">Herramientas para acompañar y apoyar emocionalmente a tus hijos.</p>
                <a href="#" class="text-green-600 font-medium hover:underline mt-2 inline-block">Leer más →</a>
            </div>

            <div class="p-6 bg-green-50 border-l-4 border-green-500 rounded-lg">
                <h3 class="text-lg font-semibold text-green-700 mb-2">Apoyo psicológico</h3>
                <p class="text-gray-600 text-sm">Líneas y servicios disponibles para atención inmediata.</p>
                <a href="#" class="text-green-600 font-medium hover:underline mt-2 inline-block">Leer más →</a>
            </div>

            <div class="p-6 bg-green-50 border-l-4 border-green-500 rounded-lg">
                <h3 class="text-lg font-semibold text-green-700 mb-2">Formación docente</h3>
                <p class="text-gray-600 text-sm">Recursos para educadores comprometidos con el bienestar estudiantil.</p>
                <a href="#" class="text-green-600 font-medium hover:underline mt-2 inline-block">Leer más →</a>
            </div>
        </div>
    </div>
</div>
@endsection
