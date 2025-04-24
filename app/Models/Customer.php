<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone_number',
        'availability',
        'customer_avatar',
        'notes',
        'session_type',
        'break_time',
    ];

    public function images()
    {
        return $this->hasMany(CustomerImage::class);
    }

    public function tattooSessions()
{
    return $this->hasMany(TattooSession::class);
}

}
