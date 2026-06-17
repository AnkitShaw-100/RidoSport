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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->json('technical_details'); // For storing key-value pairs like thickness, material, etc.
            $table->json('advantages');  
            $table->json('colors');            // For storing available colors
            $table->json('why_choose');
            $table->string('image');           // Path to the main image

            $table->json('gallery_images');    // Paths to gallery images
            $table->unsignedBigInteger('subproduct_id'); 
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('subproduct_id')->references('id')->on('product_lists')->onDelete('cascade');

            // Optional: Add index for better performance
            $table->index('subproduct_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
