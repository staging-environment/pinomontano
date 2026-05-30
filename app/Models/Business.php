<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'category',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'website',
        'logo',
        'banner_image',
        'is_featured',
        'is_approved',
    ];

    /**
     * Get reviews for this business.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class)->where('is_approved', true);
    }

    /**
     * Get all reviews, including pending moderation.
     */
    public function allReviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Accessor for average rating.
     */
    public function getAverageRatingAttribute()
    {
        $avg = $this->reviews()->avg('rating');
        return $avg ? round($avg, 1) : 0;
    }

    /**
     * Accessor for reviews count.
     */
    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }
}
