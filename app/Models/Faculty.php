<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public $timestamps = false; 
    use HasFactory;
    protected $fillable = ['faculty_id','faculty_name']; 

    public function studentCounts()
    {
        return $this->hasMany(StudentCount::class, 'faculty_id'); // Ensure 'faculty_id' matches the foreign key
    }
}
