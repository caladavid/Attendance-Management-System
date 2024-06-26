<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index()
    {
        $users = User::with(['department', 'shift'])->get();
        return view('admin.report.index', compact('users'));
    }

    public function downloadPDF(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);

         $users = User::with(['department', 'shift', 'attendances' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        }])->whereHas('attendances', function($query) use ($startDate, $endDate) {
            $query->whereBetween('date', [$startDate, $endDate]);
        })->get();

        $pdf = Pdf::loadView('admin.report.pdf', compact('users', 'startDate', 'endDate'))->setPaper('A4', 'landscape');;
        return $pdf->stream('reporte_asistencia.pdf');
    }
}
