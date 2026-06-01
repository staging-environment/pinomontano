<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_offer_id',
        'name',
        'email',
        'phone',
        'cv_path',
        'cover_letter',
    ];

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }
}
