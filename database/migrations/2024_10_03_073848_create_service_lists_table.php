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
        Schema::create('service_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Service or Sublist name
            $table->string('slug')->unique()->nullable(); // Custom slug
            $table->string('url')->nullable(); // Custom URL
            $table->unsignedBigInteger('parent_id')->nullable(); // For sublist items
            $table->timestamps();

            // Foreign key for parent_id (self-referencing)
            $table->foreign('parent_id')->references('id')->on('service_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_lists');
    }
};
