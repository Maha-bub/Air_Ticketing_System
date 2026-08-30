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
        Schema::table('flight_schedules', function (Blueprint $table) {
            $table->foreignId('airplane_id')
                ->nullable()
                ->after('route_id')
                ->constrained('airplanes')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flight_schedules', function (Blueprint $table) {
            $table->dropConstrainedForeignId('airplane_id');
        });
    }
};
