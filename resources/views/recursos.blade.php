@extends('layout')
@section('contenido')
<h2>Biblioteca de Recursos</h2>

@if($recursos->isEmpty())
  <p>No hay recursos aún.</p>
@else
  <ul>
  @foreach($recursos as $r)
    <li><b>{{ $r->titulo }}</b> — {{ $r->descripcion }}</li>
  @endforeach
  </ul>
@endif

@endsection
