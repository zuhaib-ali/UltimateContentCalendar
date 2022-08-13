<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'name' => "roles",
        ]);

        DB::table('permissions')->insert([
            'name' => "users",
        ]);

        DB::table('permissions')->insert([
            'name' => "clients",
        ]);

        DB::table('permissions')->insert([
            'name' => "projects",
        ]);

        DB::table('permissions')->insert([
            'name' => "settings",
        ]);

        DB::table('permissions')->insert([
            'name' => "calendar",
        ]);

        DB::table('permissions')->insert([
            'name' => "add client",
        ]);

        DB::table('permissions')->insert([
            'name' => "add project",
        ]);

        DB::table('permissions')->insert([
            'name' => "manage comments",
        ]);

        DB::table('permissions')->insert([
            'name' => "view comments",
        ]);

        DB::table('permissions')->insert([
            'name' => "create comment",
        ]);
    }
}
