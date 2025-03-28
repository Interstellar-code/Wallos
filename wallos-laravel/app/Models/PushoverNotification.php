<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushoverNotification extends Model
{
    use HasFactory;

    protected $table = 'pushover_notifications';

    protected $fillable = [
        'user_id',
        'enabled',
        'api_token',
        'user_key',
        'device',
        'priority',
        'sound'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}