<?php
namespace App\Models\auth;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $primaryKey = 'admin_id';

    protected $fillable = [
        'admin_username',
        'admin_password',
    ];

    protected $hidden = [
        'admin_password',
    ];

    // public $timestamps = false;

    // Overriding to match custom password field
    public function getAuthPassword()
    {
        return $this->admin_password;
    }
}
