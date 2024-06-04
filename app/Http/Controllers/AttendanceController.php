<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $currentTime = Carbon::now()->format('h:i A');
        $user = Auth::user();
        $shift = $user->shift; // Obtén el turno del usuario autenticado
        return view('attendance.index', compact('currentTime', 'shift'));
    }

    public function timeIn()
    {
        $user = Auth::user();

        if (!$user->department_id || !$user->shift_id) {
            return redirect()->route('attendance.index')->withErrors('El usuario no tiene un departamento o turno asignado.');
        }

        Attendances::create([
            'user_id' => $user->id,
            'time_in' => now()->toTimeString(),
            'date' => now()->toDateString(),
            'department_id' => $user->department_id,
            'shift_id' => $user->shift_id,
        ]);

        return redirect()->route('attendance.index')->with('status', 'Hora de entrada registrada exitosamente.');
    }

    public function timeOut()
    {
        $user = Auth::user();

        $attendance = Attendances::where('user_id', $user->id)->where('date', now()->toDateString())->firstOrFail();

        $attendance->update([
            'time_out' => now()->format('H:i:s'),
        ]);

        return redirect()->route('attendance.index')->with('status', 'Hora de salida registrada exitosamente.');
    }
}
