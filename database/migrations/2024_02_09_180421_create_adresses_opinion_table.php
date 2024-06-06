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
        Schema::create('adresses_opinion', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('latitude')->default(0.0);
            $table->double('longitude')->default(0.0);            
            $table->enum('type', ['House', 'Apartment', 'Farm', 'Shop', 'Restaurant', 'Cafe', 'Other']);
            $table->string('user_name');
            $table->text('message')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adresses_opinion');
    }
};
