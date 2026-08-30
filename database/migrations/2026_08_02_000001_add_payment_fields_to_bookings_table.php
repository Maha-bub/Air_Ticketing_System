<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_status', 30)->default('pay_at_counter')->after('payment_method');
            $table->string('payment_reference', 100)->nullable()->after('payment_status');
            $table->string('payment_transaction_id', 100)->nullable()->after('payment_reference');
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_status', 'payment_reference', 'payment_transaction_id']);
        });
    }
};
