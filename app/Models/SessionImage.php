<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'tattoo_session_id', 'url'
    ];

    public function tattooSession()
    {
        return $this->belongsTo(TattooSession::class);
    }
}
