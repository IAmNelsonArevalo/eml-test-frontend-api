<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Http\Controllers\UsersController;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            "name" => "Administrator",
            "guard_name" => "Api"
        ]);
        $this->call([
            StatusesSeeder::class,
            DocumentTypesSeeder::class,
            UsersController::class
        ]);
    }
}
