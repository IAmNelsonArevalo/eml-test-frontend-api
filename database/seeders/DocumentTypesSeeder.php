<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentType::create(array(
            "name" => "Cedula de ciudadania",
            "acronym" => "CC",
            "status_id" => 1
        ));

        DocumentType::create(array(
            "name" => "Cedula de extranjeria",
            "acronym" => "CE",
            "status_id" => 1
        ));

        DocumentType::create(array(
            "name" => "Pasaporte",
            "acronym" => "PS",
            "status_id" => 1
        ));
    }
}
