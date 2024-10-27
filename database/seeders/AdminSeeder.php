<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\auth\Admin;
use Illuminate\Support\Facades\Hash;



class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'admin_username' => 'sandesh33',
            'admin_password' => Hash::make('20590304'),
        ]);
    }
}