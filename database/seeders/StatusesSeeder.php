<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create(array(
            "name" => "Active",
            "model" => "All",
            "color_status" => "#00C853",
            "translate_status" => "Activo"
        ));

        Status::create(array(
            "name" => "Inactive",
            "model" => "All",
            "color_status" => "#D50000",
            "translate_status" => "Inactivo"
        ));
    }
}
