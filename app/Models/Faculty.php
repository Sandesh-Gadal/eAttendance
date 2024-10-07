<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    // public $timestamps = false; 
    use HasFactory;
    protected $primaryKey = 'faculty_id';
    protected $fillable = ['faculty_id','faculty_name']; 
   

    public function students()
    {
        return $this->hasMany(Student::class, 'faculty_id');
    }
}
