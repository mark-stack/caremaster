<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Admin user
        DB::table('users')->insert([
            'name' => fake()->name,
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        //Create companies
        Company::factory(10)->create();
    }
}
