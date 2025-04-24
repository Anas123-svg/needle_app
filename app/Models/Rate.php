<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'rate', 'session_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
