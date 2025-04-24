<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TattooSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'customer_id', 'session_type', 'timer', 'invoice', 'notes'
    ];

    public function images()
    {
        return $this->hasMany(SessionImage::class);
    }
    public function customer()
{
    return $this->belongsTo(Customer::class, 'customer_id');
}

}
