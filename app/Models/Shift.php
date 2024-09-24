<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    public $timestamps = false; 
    protected $fillable = ['shift_name', 'shift_start_time', 'shift_end_time'];
}
