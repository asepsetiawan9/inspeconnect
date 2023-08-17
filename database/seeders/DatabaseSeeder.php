<?php

namespace Database\Seeders;

use App\Models\Poverty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //seeder penduduk
        // Poverty::factory()->count(500)->create();

        // seeder user
        DB::table('users')->insert([
            'username' => 'adminekliwas',
            'firstname' => 'E',
            'lastname' => 'Kliwas',
            'role' => 'admin',
            'status' => 1,
            'email' => 'admin@ekliwas.com',
            'password' => bcrypt('admin')
        ]);
    }

}
