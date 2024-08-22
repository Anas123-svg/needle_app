<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;


class Artist extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'birthdate',
        'nickname',
        'email',
        'studio_name',
        'studio_address',
        'studio_phone_number',
        'time_zone',
        'webpage',
        'instagram',
        'facebook_page',
        'tax_number_1',
        'tax_number_2',
        'password',
        'invoice_note',
        'tattoo_rate',
        'consultation_rate',
        'drawing_rate',
        'wifi_qr_code_path',
        'profile_image',

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthdate' => 'date',
    ];
}
