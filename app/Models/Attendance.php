<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'group_id',
        'student_id',
        'is_attended',
        'attendance_date',
    ];
}
