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
        Schema::create('position_comfort_category', function (Blueprint $table) {
            $table->id();

            $table->foreignId('position_id')->constrained('positions')->onDelete('cascade');
            $table->foreignId('comfort_category_id')->constrained('comfort_categories')->onDelete('cascade');

            $table->unique(['position_id', 'comfort_category_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('position_comfort_categories');
    }
};
