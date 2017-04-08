<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username'  => 'admin',
            'email'     => 'admin@admin.me',
            'password'  => bcrypt('admin'),
        ]);
    }
}
