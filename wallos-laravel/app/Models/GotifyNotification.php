<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GotifyNotification extends Model
{
    use HasFactory;

    protected $table = 'gotify_notifications';

    protected $fillable = [
        'user_id',
        'enabled',
        'server_url',
        'app_token',
        'priority'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}