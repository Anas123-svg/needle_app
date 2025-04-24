<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'portfolio_image_category_id',
        'customer_id',
        'url',
        'picture_notes',
        'date',
        'rate',
        'hours',
        'taxes',
        'favourite',
    ];

    /**
     * Relationship with User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with PortfolioImageCategory
     */
    public function category()
    {
        return $this->belongsTo(PortfolioImageCategory::class, 'portfolio_image_category_id');
    }

    /**
     * Relationship with Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
