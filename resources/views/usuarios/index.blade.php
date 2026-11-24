<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Usuarios | Miku System</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #f5f7fa;
            padding: 35px 20px;
            color: #202124;
        }

        .contenedor {
            width: 100%;
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 35px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.06);
        }

        h1 {
            text-align: center;
            color: #2196a6;
            margin-bottom: 10px;
        }

        .subtitulo {
            text-align: center;
            color: #e879a9;
            margin-bottom: 30px;
        }

        .encabezado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .cantidad {
            color: #666;
            font-size: 14px;
        }

        .tabla-contenedor {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 550px;
        }

        th {
            background: #eaf5f7;
            color: #2196a6;
            padding: 14px;
            text-align: left;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #eee;
            color: #444;
        }

        tr:hover td {
            background: #fafcfd;
        }

        .rol {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background: #fce4ef;
            color: #b84d7b;
            font-size: 12px;
            font-weight: bold;
        }

        .vacio {
            text-align: center;
            padding: 30px;
            color: #888;
        }

        .boton {
            display: inline-block;
            padding: 11px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .boton-azul {
            background: #1a73e8;
            color: white;
        }

        .boton-azul:hover {
            background: #1765cc;
        }

        .boton-turquesa {
            background: #2196a6;
            color: white;
        }

        .boton-turquesa:hover {
            background: #187d8b;
        }

        .regresar {
            display: block;
            text-align: center;
            margin-top: 25px;
            color: #2196a6;
            text-decoration: none;
        }

        .regresar:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>初音ミク ♡</h1>

    <p class="subtitulo">ADMINISTRACIÓN DE USUARIOS</p>

    <div class="encabezado">

        <h2>Usuarios registrados</h2>

        <a href="{{ route('usuarios.crear') }}"
           class="boton boton-azul">
            + Registrar usuario
        </a>

        @if (Auth::user()->rol === 'admin')
        <a href="{{ route('usuarios.eliminados') }}"
        class="boton boton-azul">
        Ver usuarios eliminados
        </a>
        @endif

    </div>

    <p class="cantidad">
        Total de usuarios activos: {{ $usuarios->count() }}
    </p>

    <div class="tabla-contenedor">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo electrónico</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>

                @forelse ($usuarios as $usuario)

                    <tr>
                        <td>{{ $usuario->id }}</td>

                        <td>{{ $usuario->nombre }}</td>

                        <td>{{ $usuario->email }}</td>

                        <td>
                            <span class="rol">
                                {{ ucfirst($usuario->rol) }}
                            </span>
                        </td>

                        <td>
                            {{-- Consultar información del usuario --}}
                            <a href="{{ route('usuarios.mostrar', $usuario->id) }}">
                                Ver detalles
                            </a>

                            {{-- Editar información del usuario --}}
                            <a href="{{ route('usuarios.editar', $usuario->id) }}">
                                Editar
                            </a>

                            {{-- Solamente el administrador puede eliminar --}}
                            @if (Auth::user()->rol === 'admin')

                                <form action="{{ route('usuarios.eliminar', $usuario->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit">
                                        Eliminar
                                    </button>

                                </form>

                            @endif
                        </td>
                    </tr>

                @empty

                    <tr>
                        <td colspan="4" class="vacio">
                            No hay usuarios registrados.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <a href="{{ route('home') }}" class="regresar">
        ← Volver al Home
    </a>

</div>

</body>
</html>
