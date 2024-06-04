<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ReportIndex extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $users = User::with(['department', 'shift', 'attendances'])->paginate();

        return view('livewire.admin.report-index', compact('users'));
    }

}
