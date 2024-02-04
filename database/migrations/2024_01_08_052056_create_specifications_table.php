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
        Schema::create('specifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained();
            $table->string('shape')->nullable();
            $table->string('measurements')->nullable();
            $table->double('carat_weight')->nullable();
            $table->integer('color_grade')->nullable();
            $table->integer('clarity_grade')->nullable();
            $table->integer('cut_grade')->nullable();
            $table->string('polish')->nullable();
            $table->string('symmetry')->nullable();
            $table->string('fluorescence')->nullable();
            $table->string('clarity_characteristics')->nullable();
            $table->string('certification')->nullable();
            $table->string('origin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specifications');
    }
};
