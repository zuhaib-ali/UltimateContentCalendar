<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'img' => "1635835754_zuhaib_zuhaib.jpg",
            'first_name' => "fadmin",
            'last_name' => "ladmin",
            'address' => "GBS hyderabad",
            'email' => "admin@admin.com",
            'password' => Hash::make("admin"),
            'role_id' => 1
        ]);
    }
}
