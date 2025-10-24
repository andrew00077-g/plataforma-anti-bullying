@extends('layout')

@section('content')
<div class="min-h-screen bg-gradient-to-r from-red-50 to-rose-100 flex justify-center py-12">
    <div class="bg-white p-10 rounded-3xl shadow-2xl w-full max-w-xl">
        <h2 class="text-3xl font-bold text-red-700 mb-8 text-center"> Reportar un Caso de Bullying</h2>

        <form method="POST" action="{{ route('denuncias.store') }}" class="space-y-6">
            @csrf

            <!-- Nombre -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tu nombre (opcional)</label>
                <input type="text" name="nombre" placeholder="Ej: Juan Pérez"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-400 focus:outline-none">
            </div>

            <!-- Descripción -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Descripción del incidente</label>
                <textarea name="descripcion" rows="4" placeholder="Describe brevemente lo sucedido..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-400 focus:outline-none"></textarea>
            </div>

            <!-- Lugar -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Lugar del incidente</label>
                <input type="text" name="lugar" placeholder="Ej: Aula 12, patio..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-400 focus:outline-none">
            </div>

            <!-- Tipo y Fecha en fila -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Tipo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de bullying</label>
                    <select name="tipo"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-400 focus:outline-none">
                        <option value="">Seleccione...</option>
                        <option value="Verbal">Verbal</option>
                        <option value="Físico">Físico</option>
                        <option value="Psicológico">Psicológico</option>
                        <option value="Cibernético">Cibernético</option>
                    </select>
                </div>

                <!-- Fecha -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Fecha del incidente</label>
                    <input type="date" name="fecha"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-red-400 focus:outline-none">
                </div>
            </div>

            <!-- Botón enviar -->
            <button type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition-all duration-200 shadow-md hover:shadow-lg">
                Enviar denuncia
            </button>
        </form>
    </div>
</div>
@endsection
