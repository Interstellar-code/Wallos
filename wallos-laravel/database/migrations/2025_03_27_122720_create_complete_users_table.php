<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // Laravel default columns
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            
            // Wallos custom columns
            $table->string('main_currency', 3)->default('USD');
            $table->string('language', 5)->default('en');
            $table->boolean('is_admin')->default(false);
            $table->boolean('email_verified')->default(false);
            $table->string('api_key')->nullable();
            $table->boolean('totp_enabled')->default(false);
            $table->string('totp_secret')->nullable();
            $table->boolean('two_factor_enabled')->default(false);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};