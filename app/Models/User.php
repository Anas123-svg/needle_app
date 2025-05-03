<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use HasFactory;

    protected $fillable = [
        'artist_name',
        'artist_email',
        'studio_name',
        'studio_address',
        'facebook',
        'instagram',
        'password',
        'invoice_note',
        'is_premium_user',
        'free_trial',
        'profile_image',
        'phone',
        'currency',
        'weekly_summary_email',
        'weekly_summary',
        'BookingRemainderToClients',
        'email_verification_code',
        'is_email_verified',    
    ];

    protected $hidden = [
        'password',
    ];
    public function taxes()
    {
        return $this->hasOne(Tax::class, 'user_id');
    }
    public function rates()
    {
        return $this->hasMany(Rate::class, 'user_id');
    }

    public function tattooSessions()
    {
        return $this->hasMany(TattooSession::class, 'user_id');
    }

    public function portfolioImages()
    {
        return $this->hasMany(PortfolioImage::class, 'user_id');
    }


    public function customers()
    {
        return $this->hasMany(Customer::class, 'user_id');
    }
}
