<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['artist_id', 'cover_image', 'images','gallery_name'];

    protected $casts = [
        'images' => 'array',
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
    public function images()
{
    return $this->hasMany(GalleryImage::class);
}

}
