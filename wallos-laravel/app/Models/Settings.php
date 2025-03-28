<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'user_id',
        'dark_theme',
        'compact_mode',
        'language',
        'timezone',
        'date_format',
        'time_format',
        'currency_format',
        'first_day_of_week'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}