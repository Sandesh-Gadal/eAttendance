<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public $timestamps = false; 
    use HasFactory;
    protected $primaryKey = 'faculty_id';
    protected $fillable = ['faculty_id','faculty_name']; 

    public function studentCounts()
    {
        return $this->hasMany(StudentCount::class,'id','faculty_id'); // Ensurye 'faculty_id' matches the foreign key
    }
}
