@extends('layout')
@section('contenido')
<h2>Denuncia anónima</h2>

@if(session('success'))
  <div style="color:green">{{ session('success') }}</div>
@endif

<form action="{{ route('denuncias.store') }}" method="POST">
    @csrf
    <label>Descripción del caso</label>
    <textarea name="descripcion" required rows="5"></textarea>

    <label>Tipo de bullying</label>
    <input type="text" name="tipo">

    <label>Lugar</label>
    <input type="text" name="lugar">

    <label>Fecha</label>
    <input type="date" name="fecha">

    <button type="submit">Enviar anónimamente</button>
</form>
@endsection
