<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramNotification extends Model
{
    use HasFactory;

    protected $table = 'telegram_notifications';

    protected $fillable = [
        'user_id',
        'enabled',
        'bot_token',
        'chat_id',
        'parse_mode'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}