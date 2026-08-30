<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * NOTE: .env has SESSION_DRIVER=database, which means Laravel stores
     * every session (login state, CSRF tokens, flash messages, the cart,
     * the "intended URL" used to send guests back to what they were doing
     * after login, etc.) as a row in this table. Without it, anything that
     * touches the session — most visibly, submitting the login form —
     * fails with a database error as soon as the framework tries to
     * persist the session.
     */
    public function up(): void
    {
        if (Schema::hasTable('sessions')) {
            return;
        }

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
