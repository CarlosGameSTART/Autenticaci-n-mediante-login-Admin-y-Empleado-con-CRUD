
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Hatsune Miku | Home</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f5f7fa;
            color: #202124;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .contenedor {
            width: 100%;
            max-width: 850px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 15px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0,0,0,0.06);
        }

        .miku {
            color: #2196a6;
            font-size: 38px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitulo {
            color: #e879a9;
            margin-bottom: 30px;
            letter-spacing: 3px;
            font-size: 13px;
        }

        .bienvenida {
            font-size: 27px;
            margin-bottom: 15px;
            color: #202124;
        }

        .usuario {
            color: #2196a6;
        }

        .tarjeta {
            background: #f8fbfc;
            border: 1px solid #dcebed;
            border-radius: 12px;
            padding: 25px;
            margin: 30px 0;
        }

        .tarjeta h2 {
            color: #2196a6;
            margin-bottom: 15px;
        }

        .rol {
            display: inline-block;
            margin-top: 12px;
            padding: 8px 20px;
            border-radius: 20px;
            background: #fce4ef;
            color: #b84d7b;
            font-weight: bold;
            font-size: 14px;
        }

        .mensaje {
            color: #666;
            margin-bottom: 20px;
        }

        .datos {
            color: #444;
            margin-top: 12px;
        }

        button {
            background: #1a73e8;
            color: white;
            border: none;
            padding: 13px 30px;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #1765cc;
        }

        .administrar {
            display: inline-block;
            background: #2196a6;
            color: white;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 25px;
            transition: 0.3s;
        }

        .administrar:hover {
            background: #187d8b;
        }

        .pie {
            margin-top: 30px;
            color: #888;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="contenedor">

        <div class="miku">初音ミク ♡</div>

        <p class="subtitulo">HATSUNE MIKU SYSTEM</p>

        <h1 class="bienvenida">
            ¡Bienvenido, <span class="usuario">{{ Auth::user()->nombre }}</span>!
        </h1>

        <p>Has iniciado sesión correctamente.</p>

        <div class="tarjeta">

            <h2>Panel principal 🎵</h2>

            <p class="mensaje">
                ¡Qué bueno tenerte por aquí!
            </p>

            <p class="datos">
                Usuario: {{ Auth::user()->nombre }}
            </p>

            <p class="datos">
                Tu rol dentro del sistema:
            </p>

            <span class="rol">
                {{ Auth::user()->rol }}
            </span>

            {{-- Ambos roles pueden acceder al CRUD de usuarios --}}
            <div>
                <a href="{{ route('usuarios.index') }}"
                    class="administrar">
                    Administrar usuarios ♡
                </a>
            </div>

        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>

        <div class="pie">
            Powered by Hatsune Miku ♪
        </div>

    </div>

</body>
</html>

