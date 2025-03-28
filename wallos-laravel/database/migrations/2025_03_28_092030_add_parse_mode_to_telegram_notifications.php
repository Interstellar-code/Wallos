<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('telegram_notifications', function (Blueprint $table) {
            $table->string('parse_mode', 10)
                ->nullable()
                ->after('chat_id')
                ->comment('Message parsing mode (HTML/Markdown)');
        });
    }

    public function down()
    {
        Schema::table('telegram_notifications', function (Blueprint $table) {
            $table->dropColumn('parse_mode');
        });
    }
};