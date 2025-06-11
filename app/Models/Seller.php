<?php

namespace App\Models;

use App\Notifications\SellerResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Seller extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $guarded = ['id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'dob', 'gender',
        'password', 'companyname', 'bio', 'image',
        'address', 'city', 'state', 'zip',
        'nin', 'nin_photo', 'status', 'kyc_status', 'type'
    ];

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SellerResetPassword($token));
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function cityy(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city');
    }

    public function sate(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function chat(): HasMany
    {
        return $this->hasMany(Chat::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(SellerReview::class);
    }
}
