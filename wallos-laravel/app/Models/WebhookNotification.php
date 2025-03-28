<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebhookNotification extends Model
{
    use HasFactory;

    protected $table = 'webhook_notifications';

    protected $fillable = [
        'user_id',
        'enabled',
        'webhook_url',
        'auth_type',
        'auth_token',
        'custom_headers',
        'content_type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}