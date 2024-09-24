<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'student_info';
    protected $fillable = [
        'student_nfc_id',
        'student_name',
        'student_rollno',
        'student_dob',
        'student_semester',
        'student_section',
        'faculty_id',
        'shift_id',
        'student_contact',
        'student_address',
        'student_guardian_phno',
    ];
    public function faculty()
    { 
      
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
}
