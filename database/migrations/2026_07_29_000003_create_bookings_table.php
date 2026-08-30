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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('pnr', 20)->unique(); // booking reference shown to the passenger
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('flight_schedule_id')->constrained('flight_schedules')->cascadeOnDelete();

            $table->string('passenger_name', 150);
            $table->string('passenger_email', 150);
            $table->string('passenger_phone', 30);

            $table->json('seats');                 // e.g. ["3A","3B"]
            $table->unsignedTinyInteger('seat_count');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_amount', 10, 2);

            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('confirmed');
            $table->string('payment_method', 30)->default('cash_on_counter');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
