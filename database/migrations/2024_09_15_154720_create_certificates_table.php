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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certified_by_logo')->nullable(); // URL or file path for the logo
            $table->string('certified_by_company_name'); // Name of the certifying company
            $table->string('certified_for'); // Who/what the certificate is for
            $table->string('product_name'); // Name of the certified product
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
