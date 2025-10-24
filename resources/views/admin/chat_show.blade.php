@extends('layout')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-sky-100 flex flex-col items-center py-12">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-5xl p-6">
        <h2 class="text-2xl font-bold text-blue-700 text-center mb-6">
             Chat con {{ $usuario }}
        </h2>

        <div id="chat-box" class="flex flex-col space-y-2 h-96 overflow-y-auto border rounded-lg p-4 bg-gray-50">
            <div class="text-gray-500 text-sm text-center">Cargando mensajes...</div>
        </div>

        <form id="admin-chat-form" class="mt-4 flex gap-2">
            @csrf
            <input type="text" id="mensaje" name="mensaje" placeholder="Responder..."
                class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition">Enviar</button>
        </form>
    </div>
</div>

<script>
const chatBox = document.getElementById('chat-box');
const form = document.getElementById('admin-chat-form');
const mensajeInput = document.getElementById('mensaje');

function renderMessages(messages) {
    chatBox.innerHTML = '';
    messages.forEach(m => {
        const bubble = document.createElement('div');
        bubble.className = `p-3 rounded-xl max-w-xs ${
            m.usuario === 'Administrador' ? 'bg-blue-100 self-end ml-auto' : 'bg-gray-200 self-start'
        }`;
        bubble.innerHTML = `<strong>${m.usuario}</strong><br>${m.mensaje}${
            m.severity && m.severity !== 'none' ? `<br><small>Riesgo: ${m.severity}</small>` : ''
        }`;
        chatBox.appendChild(bubble);
    });
    chatBox.scrollTop = chatBox.scrollHeight;
}

async function fetchMessages() {
    const res = await fetch("{{ route('admin.chat.show', $usuario) }}", { headers: {'X-Requested-With':'XMLHttpRequest'} });
    if (res.ok) {
        const data = await res.json();
        renderMessages(data);
    }
}

form.addEventListener('submit', async e => {
    e.preventDefault();
    const mensaje = mensajeInput.value.trim();
    if (!mensaje) return;
    const token = document.querySelector('input[name="_token"]').value;
    await fetch("{{ route('admin.chat.adminStore') }}", {
        method: 'POST',
        headers: {'Content-Type': 'application/json','X-CSRF-TOKEN': token},
        body: JSON.stringify({mensaje})
    });
    mensajeInput.value = '';
    fetchMessages();
});

setInterval(fetchMessages, 2000);
fetchMessages();
</script>
@endsection
