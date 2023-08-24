<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->hasProfile()->create([
            'name' => 'Geop',
            'username' => 'geopp',
            'email' => 'geop@geop.com',
        ]);

        \App\Models\User::factory(5)->hasProfile()->create();

        $this->call([
            RoleSeeder::class,
            FacultySeeder::class,
            SiaSeeder::class,
        ]);

        DB::table('role_user')->insert([
            [
                'role_id' => 3,
                'user_id' => 1
            ],
        ]);
    }
}
