<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verificación</title>

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

        .icono {
            text-align: center;
            font-size: 35px;
            color: #2196a6;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center;
            color: #202124;
            font-size: 23px;
            font-weight: normal;
            margin-bottom: 12px;
        }

        .descripcion {
            text-align: center;
            color: #666;
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        label {
            display: block;
            color: #333;
            font-size: 14px;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 15px;
            border: 1px solid #dadce0;
            border-radius: 6px;
            font-size: 22px;
            text-align: center;
            letter-spacing: 8px;
            outline: none;
            margin-bottom: 20px;
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

        <div class="icono">
            ✉
        </div>

        <h1>Verifica tu identidad</h1>

        <p class="descripcion">
            Hemos enviado un código de seguridad a tu correo electrónico.
            Introduce los seis dígitos para continuar.
        </p>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('verificacion.validar') }}" method="POST">

            @csrf

            <label>Código de verificación</label>

            <input
                type="text"
                name="codigo"
                maxlength="6"
                minlength="6"
                pattern="[0-9]{6}"
                inputmode="numeric"
                autocomplete="one-time-code"
                placeholder="000000"
                required
                autofocus
            >

            <button type="submit">
                Verificar código
            </button>

        </form>

        <div class="pie">
            El código tiene una vigencia de 5 minutos.
        </div>

    </div>

</body>
</html>