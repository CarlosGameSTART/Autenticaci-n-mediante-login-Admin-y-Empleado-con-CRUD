<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Usuarios eliminados | Miku System</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f5f7fa;
            padding: 35px;
        }

        .contenedor {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 30px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.06);
        }

        h1 {
            color: #2196a6;
            text-align: center;
        }

        .subtitulo {
            color: #e879a9;
            text-align: center;
            letter-spacing: 2px;
            font-size: 13px;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #f5f7fa;
            color: #2196a6;
        }

        .boton {
            padding: 9px 14px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .boton:hover {
            background: #1765cc;
        }

        .mensaje {
            text-align: center;
            color: #777;
            padding: 25px;
        }

        a {
            display: inline-block;
            color: #2196a6;
            text-decoration: none;
            margin-top: 25px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>初音ミク ♡</h1>

    <p class="subtitulo">USUARIOS ELIMINADOS</p>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Fecha de eliminación</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($usuarios as $usuario)

                <tr>
                    <td>{{ $usuario->id }}</td>

                    <td>{{ $usuario->nombre }}</td>

                    <td>{{ $usuario->email }}</td>

                    <td>{{ ucfirst($usuario->rol) }}</td>

                    <td>{{ $usuario->deleted_at }}</td>

                    <td>
                        <form action="{{ route('usuarios.restaurar', $usuario->id) }}"
                              method="POST">

                            @csrf
                            @method('PUT')

                            <button type="submit" class="boton">
                                Restaurar
                            </button>
                        </form>

                        <form action="{{ route('usuarios.eliminarPermanente', $usuario->id) }}"
                                method="POST"
                                onsubmit="return confirm('¿Estás seguro? Esta acción eliminará definitivamente al usuario y no se podrá recuperar.')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="boton">
                                    Eliminar permanentemente
                                </button>
                            </form>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="6" class="mensaje">
                        No hay usuarios eliminados ♡
                    </td>
                </tr>

            @endforelse

        </tbody>
    </table>

    <a href="{{ route('usuarios.index') }}">
        ← Volver al listado de usuarios
    </a>

</div>

</body>
</html>
