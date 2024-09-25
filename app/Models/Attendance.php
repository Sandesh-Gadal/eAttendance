<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $primaryKey = 'attendance_id';

    protected $fillable = [
        'student_nfc_id',
        'attendance_entry_time',
        'attendance_remarks',
        'attendance_date'
    ];

    public $timestamps = false;

    // Define relationship with student_info
    public function student()
    {
        return $this->belongsTo(StudentInfo::class, 'student_nfc_id');
    }
}
