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
        if (! Schema::hasTable('blogs')) {
            return;
        }

        Schema::table('blogs', function (Blueprint $table) {
            if (! Schema::hasColumn('blogs', 'title')) {
                $table->string('title')->nullable()->after('id');
            }

            if (! Schema::hasColumn('blogs', 'slug')) {
                $table->string('slug')->nullable()->unique()->after('title');
            }

            if (! Schema::hasColumn('blogs', 'content')) {
                $table->longText('content')->nullable()->after('slug');
            }

            if (! Schema::hasColumn('blogs', 'banner_image_url')) {
                $table->string('banner_image_url')->nullable()->after('content');
            }

            if (! Schema::hasColumn('blogs', 'banner_public_id')) {
                $table->string('banner_public_id')->nullable()->after('banner_image_url');
            }

            if (! Schema::hasColumn('blogs', 'status')) {
                $table->string('status')->default('published')->after('banner_public_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('blogs')) {
            return;
        }

        Schema::table('blogs', function (Blueprint $table) {
            $columns = array_filter([
                Schema::hasColumn('blogs', 'banner_public_id') ? 'banner_public_id' : null,
                Schema::hasColumn('blogs', 'status') ? 'status' : null,
                Schema::hasColumn('blogs', 'banner_image_url') ? 'banner_image_url' : null,
                Schema::hasColumn('blogs', 'content') ? 'content' : null,
                Schema::hasColumn('blogs', 'slug') ? 'slug' : null,
                Schema::hasColumn('blogs', 'title') ? 'title' : null,
            ]);

            if ($columns) {
                $table->dropColumn($columns);
            }
        });
    }
};
