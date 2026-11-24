<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del usuario | Miku System</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .contenedor {
            width: 100%;
            max-width: 500px;
            padding: 35px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.06);
        }

        h1 {
            color: #2196a6;
            text-align: center;
        }

        .subtitulo {
            text-align: center;
            color: #e879a9;
            margin-bottom: 30px;
        }

        .dato {
            padding: 14px;
            border-bottom: 1px solid #eee;
            color: #444;
        }

        .dato strong {
            color: #2196a6;
        }

        .rol {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #fce4ef;
            color: #b84d7b;
            font-size: 13px;
            font-weight: bold;
        }

        a {
            display: block;
            margin-top: 25px;
            text-align: center;
            color: #2196a6;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>初音ミク ♡</h1>

    <p class="subtitulo">DETALLES DEL USUARIO</p>

    <div class="dato">
        <strong>ID:</strong> {{ $usuario->id }}
    </div>

    <div class="dato">
        <strong>Nombre:</strong> {{ $usuario->nombre }}
    </div>

    <div class="dato">
        <strong>Correo:</strong> {{ $usuario->email }}
    </div>

    <div class="dato">
        <strong>Rol:</strong>
        <span class="rol">{{ ucfirst($usuario->rol) }}</span>
    </div>

    <div class="dato">
        <strong>Fecha de registro:</strong>
        {{ $usuario->created_at->format('d/m/Y H:i') }}
    </div>

    <a href="{{ route('usuarios.index') }}">
        ← Volver al listado
    </a>

</div>

</body>
</html>
