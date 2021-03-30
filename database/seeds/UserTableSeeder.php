<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'image' => 'admin.png'
        ]);
        $user->attachRole('super_admin');
    }
}
// pw
// 25031992