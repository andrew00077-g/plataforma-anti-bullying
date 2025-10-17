<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Plataforma Anti-Bullying</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.css">
    <style>
      header nav a { margin-right: 12px; }
      .container { max-width: 900px; margin: auto; padding: 10px; }
      .msg { border-radius:6px; padding:6px; margin-bottom:8px; }
      .flagged { background: #ffe6e6; border: 1px solid #ff9999; }
    </style>
</head>
<body>
<header>
    <h1>💬 Plataforma contra el Bullying</h1>
    <nav>
        <a href="{{ route('home') }}">Inicio</a>
        <a href="{{ route('denuncias.index') }}">Denunciar</a>
        <a href="{{ route('chat.index') }}">Chat</a>
        <a href="{{ route('recursos.index') }}">Recursos</a>
        <a href="{{ route('denuncias.lista') }}">Lista Denuncias</a>
    </nav>
</header>

<main class="container">
    @yield('contenido')
</main>
</body>
</html>
