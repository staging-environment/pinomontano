<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'salary_range',
        'active',
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
