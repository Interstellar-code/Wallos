<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'email',
        'password',
        'api_key',
        'is_admin',
        'email_verified',
        'totp_enabled',
        'totp_secret',
        'household_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function currencies()
    {
        return $this->hasMany(Currency::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function household()
    {
        return $this->belongsTo(Household::class);
    }

    public function householdMembers()
    {
        return $this->hasMany(User::class, 'household_id');
    }

    public function paymentMethods()
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function settings()
    {
        return $this->hasOne(Settings::class);
    }

    public function notificationSettings()
    {
        return $this->hasOne(NotificationSettings::class);
    }

    public function emailNotifications()
    {
        return $this->hasOne(EmailNotification::class);
    }

    public function discordNotifications()
    {
        return $this->hasOne(DiscordNotification::class);
    }

    public function gotifyNotifications()
    {
        return $this->hasOne(GotifyNotification::class);
    }

    public function ntfyNotifications()
    {
        return $this->hasOne(NtfyNotification::class);
    }

    public function pushoverNotifications()
    {
        return $this->hasOne(PushoverNotification::class);
    }

    public function telegramNotifications()
    {
        return $this->hasOne(TelegramNotification::class);
    }

    public function webhookNotifications()
    {
        return $this->hasOne(WebhookNotification::class);
    }
}
