<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("document_types", function (Blueprint $table) {
            $table->increments("id");
            $table->string("name");
            $table->string("acronym");
            $table->unsignedInteger("status_id");
            $table->foreign("status_id")->references("id")->on("statuses")->onUpdate("no action")->onDelete("no action");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("document_types", function(Blueprint $table){
            $table->dropForeign(['status_id']);
        });

        Schema::dropIfExists("document_types");
    }
};
