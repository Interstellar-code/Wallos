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
        Schema::create('ntfy_notifications', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->boolean('enabled')->default(false);
            $table->timestamps();
            $table->text('server_url')->default('');
            $table->text('topic')->default('');
            $table->integer('priority')->default(5);
            $table->text('auth_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ntfy_notifications');
    }
};
