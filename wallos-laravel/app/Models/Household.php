<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Household extends Model
{
    use HasFactory;

    protected $table = 'household';

    protected $fillable = [
        'user_id',
        'name',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'payer_user_id');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
