<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            "uid" => Hash::make("nelson.arevalo2119@gmail.com"),
            "name" => "Nelson Eduardo",
            "last_name" => "Arevalo Cubides",
            "email" => "nelson.arevalo2119@gmail.com",
            "password" => Hash::make("password"),
            "document_type_id" => 1,
            "document" => "1018485712",
            "phone" => "3232034689",
            "status_id" => 1,
            "verified_account" => Carbon::now()->format("Y-m-d h:i:s")
        ]);

        $user->assignRole("Administrator");
    }
}
