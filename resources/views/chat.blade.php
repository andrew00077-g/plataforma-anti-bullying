@extends('layout')
@section('contenido')
<h2>Chat de apoyo confidencial</h2>

<form action="{{ route('chat.store') }}" method="POST">
    @csrf
    <label>Tu nombre (opcional)</label>
    <input type="text" name="usuario" placeholder="Anónimo">

    <label>Mensaje</label>
    <textarea name="mensaje" required rows="3"></textarea>

    <button type="submit">Enviar</button>
</form>

<hr>
<h3>Últimos mensajes</h3>
@foreach($messages as $m)
  <div class="msg {{ $m->flagged ? 'flagged' : '' }}">
    <small><strong>{{ $m->usuario ?: 'Anónimo' }}</strong> — {{ $m->created_at->format('d-m-Y H:i') }}</small>
    <p>{{ $m->mensaje }}</p>
    @if($m->flagged)
      <small>⚠️ Marcado: {{ $m->severity ?? 'alto' }}</small>
    @endif
  </div>
@endforeach

@endsection
