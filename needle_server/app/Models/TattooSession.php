<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TattooSession extends Model
{
    use HasFactory;

    protected $table = 'tattoo_session';

    protected $fillable = [
        'artist_id',
        'client_name',
        'client_email',
        'client_phone',
        'session_type',
        'session_cost',
        'timer',
        'actual_rate',
        'taxes',
        'total_rate',
        'end_session_image',
        'end_session_note',
        'images'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
