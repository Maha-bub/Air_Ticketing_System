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
        Schema::create('flight_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->constrained('routes')->cascadeOnDelete();
            $table->string('flight_number', 20);
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->string('days_of_operation', 100)->default('Daily'); // e.g. "Mon,Tue,Wed" or "Daily"
            $table->decimal('price', 10, 2)->default(0);
            $table->enum('status', ['scheduled', 'delayed', 'cancelled'])->default('scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_schedules');
    }
};
