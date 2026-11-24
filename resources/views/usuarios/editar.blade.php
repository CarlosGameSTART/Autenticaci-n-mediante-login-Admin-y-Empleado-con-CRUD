<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar usuario | Miku System</title>

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

        .formulario {
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
            font-size: 30px;
            margin-bottom: 10px;
        }

        .subtitulo {
            text-align: center;
            color: #e879a9;
            font-size: 13px;
            letter-spacing: 2px;
            margin-bottom: 25px;
        }

        label {
            display: block;
            color: #333;
            font-size: 14px;
            margin-top: 15px;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #dadce0;
            border-radius: 6px;
            background: white;
            color: #202124;
            font-size: 14px;
            outline: none;
        }

        input:focus, select:focus {
            border: 2px solid #2196a6;
        }

        button {
            width: 100%;
            margin-top: 25px;
            padding: 13px;
            border: none;
            border-radius: 6px;
            background: #1a73e8;
            color: white;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #1765cc;
        }

        .error {
            background: #fce8e6;
            color: #b3261e;
            padding: 12px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        a {
            display: block;
            text-align: center;
            color: #2196a6;
            margin-top: 22px;
            font-size: 14px;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="formulario">

    <h1>初音ミク ♡</h1>

    <p class="subtitulo">EDICIÓN DE USUARIOS</p>

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('usuarios.actualizar', $usuario->id) }}" method="POST">

        @csrf
        @method('PUT')

        <label>Nombre completo:</label>
        <input
            type="text"
            name="nombre"
            value="{{ old('nombre', $usuario->nombre) }}"
            required
        >

        <label>Correo electrónico:</label>
        <input
            type="email"
            name="email"
            value="{{ old('email', $usuario->email) }}"
            required
        >

        <label>Nueva contraseña (opcional):</label>
        <input
            type="password"
            name="password"
            placeholder="Dejar vacío para conservar la actual"
        >

        <label>Confirmar nueva contraseña:</label>
        <input
            type="password"
            name="password_confirmation"
            placeholder="Confirma la nueva contraseña"
        >

        <label>Tipo de usuario:</label>
        <select name="rol" required>
            <option value="empleado"
                {{ old('rol', $usuario->rol) == 'empleado' ? 'selected' : '' }}>
                Empleado
            </option>

            <option value="admin"
                {{ old('rol', $usuario->rol) == 'admin' ? 'selected' : '' }}>
                Administrador
            </option>
        </select>

        <button type="submit">
            Guardar cambios
        </button>

    </form>

    <a href="{{ route('usuarios.index') }}">← Volver al listado</a>

</div>

</body>
</html>
