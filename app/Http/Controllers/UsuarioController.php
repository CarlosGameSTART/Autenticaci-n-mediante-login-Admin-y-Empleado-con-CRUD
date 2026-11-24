<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UsuarioController extends Controller
{
    // Mostrar el formulario para registrar usuarios
    public function crear()
    {
        return view('usuarios.crear');
    }

    // Registrar un nuevo usuario
    public function guardar(Request $request)
    {
        // Validar los datos recibidos del formulario
        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|in:admin,empleado'
        ]);

        // Crear el usuario en la base de datos
        User::create([
            'name' => $datos['nombre'],
            'nombre' => $datos['nombre'],
            'email' => $datos['email'],
            'password' => $datos['password'],
            'rol' => $datos['rol']
        ]);

        // Regresar al formulario con un mensaje
        return redirect()->route('usuarios.crear')
            ->with('success', 'Usuario registrado correctamente.');
    }
    // Mostrar el listado de usuarios
public function index()
{
    // Obtener los usuarios que no han sido eliminados
    $usuarios = User::orderBy('id', 'desc')->get();

    // Enviar los usuarios a la vista
    return view('usuarios.index', compact('usuarios'));
}
// Mostrar los detalles de un usuario
public function mostrar($id)
{
    // Buscar al usuario por su ID
    $usuario = User::findOrFail($id);

    // Enviar sus datos a la vista
    return view('usuarios.mostrar', compact('usuario'));
}
// Mostrar el formulario para editar un usuario
public function editar($id)
{
    // Buscar al usuario por su ID
    $usuario = User::findOrFail($id);

    // Enviar sus datos a la vista de edición
    return view('usuarios.editar', compact('usuario'));
}


// Procesar la actualización de un usuario
public function actualizar(Request $request, $id)
{
    // Buscar al usuario que queremos modificar
    $usuario = User::findOrFail($id);

    // Validar los datos recibidos
    $datos = $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $usuario->id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    // Actualizar nombre y correo
    $usuario->nombre = $datos['nombre'];
    $usuario->name = $datos['nombre'];
    $usuario->email = $datos['email'];

    // Solamente el administrador puede modificar el rol
    if (auth()->user()->rol === 'admin') {
        $request->validate([
            'rol' => 'required|in:admin,empleado'
        ]);

        $usuario->rol = $request->rol;
    }

    // Si se escribió una contraseña nueva, actualizarla
    if (!empty($datos['password'])) {
        $usuario->password = $datos['password'];
    }

    // Guardar los cambios en la base de datos
    $usuario->save();

    // Regresar al listado con mensaje de éxito
    return redirect()->route('usuarios.index')
        ->with('success', 'Usuario actualizado correctamente.');
}

// Eliminar un usuario de forma lógica
public function eliminar($id)
{
    // Buscar al usuario
    $usuario = User::findOrFail($id);

    // Marcarlo como eliminado
    $usuario->delete();

    // Regresar al listado
    return redirect()->route('usuarios.index')
        ->with('success', 'Usuario eliminado correctamente.');
}
// Mostrar usuarios eliminados
public function eliminados()
{
    // Obtener únicamente los usuarios eliminados
    $usuarios = User::onlyTrashed()
        ->orderBy('id', 'desc')
        ->get();

    // Enviar los usuarios a la vista
    return view('usuarios.eliminados', compact('usuarios'));
}

// Restaurar un usuario eliminado
public function restaurar($id)
{
    // Buscar exclusivamente entre los usuarios eliminados
    $usuario = User::onlyTrashed()->findOrFail($id);

    // Restaurar el registro
    $usuario->restore();

    // Regresar a la lista de eliminados
    return redirect()->route('usuarios.eliminados')
        ->with('success', 'Usuario restaurado correctamente.');
}
public function eliminarPermanente($id)
{
    // Buscamos al usuario entre los que ya fueron eliminados
    $usuario = User::onlyTrashed()->findOrFail($id);

    // Eliminamos definitivamente el registro
    $usuario->forceDelete();

    return redirect()->route('usuarios.eliminados')
        ->with('success', 'Usuario eliminado permanentemente.');
}
}
