<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'artist_id',
        'client_name',
        'client_mail',
        'client_phone',
        'client_nickname',
        'availability',
    ];

    // Define the relationship with the Artist model
    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
