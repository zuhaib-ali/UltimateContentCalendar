<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'status_name' => "pending",
            'status_color' => "#FFBF00",
        ]);

        DB::table('colors')->insert([
            'status_name' => "in_progress",
            'status_color' => "#4682B4",
        ]);

        DB::table('colors')->insert([
            'status_name' => "approved",
            'status_color' => "#01796F",
        ]);

        DB::table('colors')->insert([
            'status_name' => "completed",
            'status_color' => "#4CBB17",
        ]);

        DB::table('colors')->insert([
            'status_name' => "revined",
            'status_color' => "#C21807",
        ]);
    }
}
