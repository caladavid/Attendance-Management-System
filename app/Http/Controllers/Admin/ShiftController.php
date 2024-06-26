<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::all();

        return view('admin.shift.index', compact('shifts'));
    }

    public function create()
    {
        return view("admin.shift.create");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
        ]);

        Shift::create($request->all());

        return redirect()->route('admin.shift.index')->with('status', 'Turno creado exitosamente.');
    }

    public function edit(string $id)
    {
        $shifts = Shift::findOrFail($id);
        return view("admin.shift.edit", compact("shifts"));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i:s',
            'end_time' => 'required|date_format:H:i:s',
        ]);

        $shifts = Shift::findOrFail($id);
        $shifts->update($request->all());
        
        return back()->with('status', 'Turno actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $shifts = Shift::findOrFail($id);
        $shifts->delete();

        return back()->with('status', 'Turno eliminado exitosamente.');
    }
}
