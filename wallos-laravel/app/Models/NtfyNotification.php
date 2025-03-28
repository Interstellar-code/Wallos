<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NtfyNotification extends Model
{
    use HasFactory;

    protected $table = 'ntfy_notifications';

    protected $fillable = [
        'user_id',
        'enabled',
        'server_url',
        'topic',
        'priority',
        'auth_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}