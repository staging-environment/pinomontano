<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    protected $fillable = [
        'business_id',
        'platform',
        'status',
        'error_message',
    ];

    /**
     * Get the business that owns the social post.
     */
    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
