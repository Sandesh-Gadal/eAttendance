<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
   public $timestamps = false ;
    protected $primaryKey = 'student_nfc_id'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 

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

    // Define relationships if any
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_nfc_id');
    }
}
