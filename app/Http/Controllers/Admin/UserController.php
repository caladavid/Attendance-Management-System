<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\Shift;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("admin.users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Departments::all();
        $shifts = Shift::all();
        $roles = Role::all();
        return view("admin.users.create", compact("departments", "shifts", "roles"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6',
            'department_id' => 'required',
            'shift_id' => 'required',
        ]);

        $user = $request->all();
        $user['joining_date'] = Carbon::now();
        User::create($user);

        return redirect()->route('admin.users.index')->with('status', 'Empleado creado exitosamente.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $shifts = Shift::all();
        $departments = Departments::all();

        return view("admin.users.edit", compact("user", "roles", "departments", "shifts"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'password' => 'nullable|string|min:6|confirmed',
            'department_id' => 'required',
            'shift_id' => 'required',
        ], [
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = User::findOrFail($id);
        // Actualizar los campos generales
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->department_id = $request->input('department_id');
        $user->shift_id = $request->input('shift_id');

        // Solo actualizar la contraseña si se ha proporcionado
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save(); // Guarda los cambios

        return redirect()->route('admin.users.index')->with('status', 'Empleado actualizado exitosamente.');
    }
    /*     public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'password' => 'nullable|string|min:6|confirmed',
            'department_id' => 'required',
            'shift_id' => 'required',
        ], [
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $users = User::findOrFail($id);
        if ($request->filled('password')) {
            $users->password = bcrypt($request->input('password'));
        }
        $users->update($request->all());

        return redirect()->route('admin.users.index')->with('status', 'Empleado actualizado exitosamente.');
    } */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('status', 'Empleado eliminado exitosamente.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.users.profile', compact('user'));
    }
}
