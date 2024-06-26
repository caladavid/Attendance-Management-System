<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Departments;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Departments::all();
        return view("admin.department.index", compact("departments"));
    }

    public function create()
    {
        return view("admin.department.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Departments::create($request->all());
        return redirect()->route('admin.departments.index')->with('status', 'Departamento creado exitosamente.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departments = Departments::findOrFail($id);
        return view("admin.department.edit", compact("departments"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $departments = Departments::findOrFail($id);
        $departments->update($request->all());
        return back()->with('status', 'Departamento actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departments = Departments::findOrFail($id);
        $departments->delete();

        return back()->with('status', 'Departamento eliminado exitosamente.');
    }
}
