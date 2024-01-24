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
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')->constrained();
            $table->string('category');
            $table->double('price');
            $table->string('shape');
            $table->string('color');
            $table->double('carat');
            $table->string('clarity');
            $table->string('cut');
            $table->string('certificate')->nullable();
            $table->date('expected_arrival_date')->nullable();
            $table->double('deposit')->nullable();
            $table->boolean('mounted')->default(false);
            $table->jsonb('mount_spec')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_orders');
    }
};
