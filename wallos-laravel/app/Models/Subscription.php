<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'amount',
        'currency_id',
        'category_id',
        'payment_method_id',
        'payer_user_id',
        'billing_cycle',
        'next_payment',
        'last_payment',
        'inactive',
        'website',
        'logo',
        'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function payer()
    {
        return $this->belongsTo(Household::class, 'payer_user_id');
    }
}
