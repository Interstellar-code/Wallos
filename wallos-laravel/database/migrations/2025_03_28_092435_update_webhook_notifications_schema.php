<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('webhook_notifications', function (Blueprint $table) {
            // Rename existing columns
            $table->renameColumn('url', 'webhook_url');
            $table->renameColumn('headers', 'custom_headers');

            // Add new columns
            $table->string('auth_type', 10)
                ->default('none')
                ->after('custom_headers');
                
            $table->text('auth_token')
                ->nullable()
                ->after('auth_type');
                
            $table->string('content_type', 50)
                ->default('application/json')
                ->after('auth_token');

            // Drop unused columns
            $table->dropColumn(['request_method', 'payload', 'iterator', 'ignore_ssl']);
        });
    }

    public function down()
    {
        Schema::table('webhook_notifications', function (Blueprint $table) {
            // Recreate dropped columns
            $table->string('request_method', 10)->default('POST');
            $table->text('payload')->default('');
            $table->text('iterator')->default('');
            $table->boolean('ignore_ssl')->default(false);

            // Remove added columns
            $table->dropColumn(['auth_type', 'auth_token', 'content_type']);

            // Revert renamed columns
            $table->renameColumn('webhook_url', 'url');
            $table->renameColumn('custom_headers', 'headers');
        });
    }
};