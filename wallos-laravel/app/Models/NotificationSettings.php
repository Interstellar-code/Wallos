<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSettings extends Model
{
    use HasFactory;

    protected $table = 'notification_settings';

    protected $fillable = [
        'user_id',
        'days',
        'time',
        'notify_before',
        'notify_day_of',
        'notify_after'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}