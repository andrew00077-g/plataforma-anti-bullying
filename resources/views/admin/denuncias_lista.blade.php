@extends('layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-10">
    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-2xl p-6">
        <h2 class="text-3xl font-bold text-red-700 mb-6 text-center"> Lista de Denuncias</h2>

        @if($denuncias->isEmpty())
            <p class="text-center text-gray-500 text-lg">No hay denuncias registradas aún.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-red-600 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Descripción</th>
                            <th class="px-4 py-2 text-left">Tipo</th>
                            <th class="px-4 py-2 text-left">Fecha</th>
                            <th class="px-4 py-2 text-left">Nivel de riego</th>
                            <th class="px-4 py-2 text-left">Detectado por IA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($denuncias as $d)
                            <tr class="hover:bg-red-50 transition">
                                <td class="px-4 py-2">{{ $d->id }}</td>
                                <td class="px-4 py-2">{{ Str::limit($d->descripcion, 80) }}</td>
                                <td class="px-4 py-2">{{ $d->tipo ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $d->fecha ?? '—' }}</td>
                                <td class="px-4 py-2">
                                    @if($d->analysis_severity)
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                                            @if($d->analysis_severity === 'high') bg-red-100 text-red-700
                                            @elseif($d->analysis_severity === 'medium') bg-yellow-100 text-yellow-700
                                            @else bg-green-100 text-green-700 @endif">
                                            {{ ucfirst($d->analysis_severity) }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">No analizado</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if($d->analysis_flagged)
                                        <span class="text-red-600 font-semibold">Sí</span>
                                    @else
                                        <span class="text-gray-500">No</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

