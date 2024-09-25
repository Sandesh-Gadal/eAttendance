<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    public $timestamps = false; 
    protected $primaryKey = 'shift_id';
    protected $fillable = ['shift_name', 'shift_start_time', 'shift_end_time'];

     // Define relationship with students
     public function students()
     {
         return $this->hasMany(StudentInfo::class, 'shift_id');
     }
}
