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
        Schema::table('userdip2s', function (Blueprint $table) {
            $table->string('image_extension')->nullable();  ////here i have added a collumn in userdip2 table for store user image extension
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('userdip2', function (Blueprint $table) {
            //
        });
    }
};
