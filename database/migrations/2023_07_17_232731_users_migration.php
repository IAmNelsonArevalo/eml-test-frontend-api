<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("users", function(Blueprint $table){
            $table->increments("id");
            $table->string("uid");
            $table->string("name");
            $table->string("last_name");
            $table->string("email");
            $table->string("password");
            $table->unsignedInteger("document_type_id");
            $table->foreign("document_type_id")->references("id")->on("document_types")->onUpdate("no action")->onDelete("no action");
            $table->string("document");
            $table->string("phone");
            $table->unsignedInteger("status_id");
            $table->foreign("status_id")->references("id")->on("statuses")->onUpdate("no action")->onDelete("no action");
            $table->dateTime("verified_account");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign(["document_type_id", "status_id"]);
        });

        Schema::dropIfExists("users");
    }
};
