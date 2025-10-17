@extends('layout')
@section('contenido')
<h2>Lista de denuncias (prototipo)</h2>

<table style="width:100%; border-collapse:collapse">
    <thead>
        <tr><th>ID</th><th>Descripción</th><th>Tipo</th><th>Fecha</th><th>Severity</th><th>Flagged</th></tr>
    </thead>
    <tbody>
    @foreach($denuncias as $d)
        <tr style="border-top:1px solid #ddd">
            <td>{{ $d->id }}</td>
            <td>{{ Str::limit($d->descripcion,80) }}</td>
            <td>{{ $d->tipo }}</td>
            <td>{{ $d->fecha }}</td>
            <td>{{ $d->analysis_severity }}</td>
            <td>{{ $d->analysis_flagged ? 'Sí' : 'No' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
