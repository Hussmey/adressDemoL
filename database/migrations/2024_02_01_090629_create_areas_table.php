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
        // Create 'post_code_areas' table if it does not exist
        if (!Schema::hasTable('post_code_areas')) {
            Schema::create('post_code_areas', function (Blueprint $table) {
                $table->id();
                $table->string('code');
                $table->timestamps();
            });
        }

        // Create 'areas' table if it does not exist
        if (!Schema::hasTable('areas')) {
            Schema::create('areas', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->unsignedBigInteger('city_id');
                $table->unsignedBigInteger('post_code_area_id')->nullable(); // Nullable
                $table->timestamps();

                // Define the foreign key constraint for 'cities'
                $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

                // Define the foreign key constraint for 'post_code_areas'
                $table->foreign('post_code_area_id')->references('id')->on('post_code_areas')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop 'areas' table if it exists
        if (Schema::hasTable('areas')) {
            // Drop foreign key constraints before dropping the table
            Schema::table('areas', function (Blueprint $table) {
                $table->dropForeign(['city_id']);
                $table->dropForeign(['post_code_area_id']);
            });

            // Drop the 'areas' table
            Schema::dropIfExists('areas');
        }

        // Drop 'post_code_areas' table if it exists
        if (Schema::hasTable('post_code_areas')) {
            // Drop the 'post_code_areas' table
            Schema::dropIfExists('post_code_areas');
        }
    }
};
