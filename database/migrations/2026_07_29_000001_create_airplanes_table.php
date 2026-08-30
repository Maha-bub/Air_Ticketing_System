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
        Schema::create('airplanes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);           // e.g. "Boeing 777-300ER"
            $table->string('model', 100)->nullable(); // e.g. "777-300ER"
            $table->string('code', 20)->unique();   // internal tail/registration code, e.g. S2-AGB
            $table->unsignedInteger('seat_rows');       // number of rows, e.g. 30
            $table->unsignedTinyInteger('seat_columns'); // seats per row, e.g. 6 (A-F)
            $table->unsignedInteger('total_seats');      // seat_rows * seat_columns (kept explicit for easy display)
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airplanes');
    }
};
