<?php

namespace App\Http\Controllers;

use App\Models\tipo_auditoria;
use App\Models\puestos;
use App\Models\cat_auditores;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function tipoAuditorias()
    {
        $options = tipo_auditoria::all();

        return response()->json($options);
    }
    public function puestos()
    {
        $options = puestos::all();

        return response()->json($options);
    }
    public function AddUser(Request $request)
    {
       // dd($request->all());

        // Crear un nuevo usuario
        $user = new User([
            'name' => $request->input('name'),
            'no_empleado'=> $request->input('no_empleado'),
            'email' => $request->input('email'),
            'password' => Hash::make($request['password']),
            'tipo_auditor' => $request->input('tipo_auditoria'),
            // Agrega asignación de otros campos
        ]);

        // Guardar el usuario en la base de datos
        $user->save();

        return back()->with('success', 'Datos guardados correctamente.');
    }

    public function editUser(Request $request)
    {

        // Obtener el ID del usuario a través del campo editId
        $userId = $request->input('editId');

        // Buscar el usuario en la base de datos
        $user = User::where('no_empleado', $userId)->first();
       // dd($user);
        // Verificar si se encontró el usuario
        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        $user->puesto = $request->input('editPuesto');
        $user->tipo_auditor = $request->input('editTipoAuditoria');
        $user->Planta = $request->input('editPlanta');
        // Guardar los cambios
        $user->save();

        return back()->with('success', 'Datos guardados correctamente.');
    }
    public function blockUser($noEmpleado)
    {
        // Obtener el usuario por no_empleado
        $user = User::where('no_empleado', $noEmpleado)->first();

        // Verificar si se encontró el usuario
        if (!$user) {
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }

        // Verificar si el estado actual es 'Baja'
        if ($user->Estatus == 'Baja') {
            // Cambiar el estado a 'Alta'
            $user->Estatus = 'Alta';
            $user->save();

            return redirect()->back()->with('success', 'Usuario activado correctamente.');
        } else {
            // Cambiar el estado a 'Baja'
            $user->Estatus = 'Baja';
            $user->save();

            return redirect()->back()->with('success', 'Usuario bloqueado correctamente.');
        }
    }


}
