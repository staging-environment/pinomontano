<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'business_id',
        'author_name',
        'rating',
        'comment',
        'is_approved',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
