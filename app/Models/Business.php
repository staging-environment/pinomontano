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
        'phone',
        'email',
        'website',
        'logo',
        'banner_image',
        'is_featured',
        'is_approved',
    ];
}
