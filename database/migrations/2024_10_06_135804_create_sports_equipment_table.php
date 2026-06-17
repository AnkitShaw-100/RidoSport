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
        Schema::create('sports_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Sports Equipment  List
            $table->string('slug')->unique()->nullable(); // Custom slug
            $table->string('url')->nullable(); // Custom URL
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sports_equipment');
    }
};
