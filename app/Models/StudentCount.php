<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCount extends Model
{
    use HasFactory;
    public $timestamps = false; // Disable timestamps
    protected $fillable = ['faculty_id', 'section', 'semester_level', 'student_number'];


    public function faculty()
    {
        return $this->belongsTo(Faculty::class,  'faculty_id');
    }
}
