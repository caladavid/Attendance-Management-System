<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'user_id',
        'time_in',
        'time_out',
        'date',
        'in_status',
        'out_status',
        'department_id',
        'shift_id'
    ];
}
