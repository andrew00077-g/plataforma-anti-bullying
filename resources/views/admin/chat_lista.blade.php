@extends('layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-sky-100 flex flex-col items-center py-12">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-4xl p-6">
        <h2 class="text-2xl font-bold text-blue-700 text-center mb-6"> Conversaciones Activas</h2>

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead class="bg-blue-100">
                <tr>
                    <th class="border px-4 py-2">Usuario</th>
                    <th class="border px-4 py-2">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $u)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-4 py-2">{{ $u->usuario === 'Administrador' ? 'Administrador' : 'Anónimo' }}</td>
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ route('admin.chat.show', $u->usuario) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                Entrar al chat
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="2" class="text-center py-4 text-gray-500">No hay conversaciones activas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
