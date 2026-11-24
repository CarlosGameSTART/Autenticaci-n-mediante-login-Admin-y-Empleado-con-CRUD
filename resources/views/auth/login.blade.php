<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Iniciar sesión</title>

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
            background: white;
            width: 100%;
            max-width: 420px;
            padding: 40px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        .logo {
            text-align: center;
            color: #2196a6;
            font-size: 25px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        h1 {
            text-align: center;
            color: #202124;
            font-size: 25px;
            font-weight: normal;
            margin-bottom: 10px;
        }

        .descripcion {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            color: #333;
            font-size: 14px;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 13px;
            border: 1px solid #dadce0;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border: 2px solid #2196a6;
        }

        button {
            width: 100%;
            padding: 13px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #1765cc;
        }

        .error {
            background: #fce8e6;
            color: #b3261e;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .pie {
            text-align: center;
            color: #888;
            font-size: 12px;
            margin-top: 25px;
        }
    </style>
</head>

<body>

    <div class="contenedor">

        <div class="logo">
            Sistema Login 😎
        </div>

        <h1>Iniciar sesión</h1>

        <p class="descripcion">
            Ingresa tus credenciales para continuar.
        </p>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">

            @csrf

            <label>Correo electrónico</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="ejemplo@correo.com"
                required
            >

            <label>Contraseña</label>

            <input
                type="password"
                name="password"
                placeholder="Ingresa tu contraseña"
                required
            >

            <button type="submit">
                Iniciar sesión
            </button>

        </form>

        <div class="pie">
            Sistema de acceso seguro
        </div>

    </div>

</body>
</html>



