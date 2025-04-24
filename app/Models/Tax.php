<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tax1',
        'tax2',
        'tax3',
        'tax4',
        'is_tax1_valid',
        'is_tax2_valid',
        'is_tax3_valid',
        'is_tax4_valid',
        'no_of_valid_taxes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
