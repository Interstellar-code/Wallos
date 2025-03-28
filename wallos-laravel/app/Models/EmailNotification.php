<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    use HasFactory;

    protected $table = 'email_notifications';

    protected $fillable = [
        'user_id',
        'enabled',
        'email_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}