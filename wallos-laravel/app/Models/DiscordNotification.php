<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscordNotification extends Model
{
    use HasFactory;

    protected $table = 'discord_notifications';

    protected $fillable = [
        'user_id',
        'enabled',
        'webhook_url',
        'bot_name',
        'bot_avatar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}