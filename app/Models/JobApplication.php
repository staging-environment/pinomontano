<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_offer_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'profile_description',
        'cv_path',
        'cover_letter',
    ];

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }

    /**
     * Get a temporary signed URL for the CV (only for authenticated users).
     */
    public function getCvUrlAttribute()
    {
        return \Storage::disk('private_cvs')->temporaryUrl($this->cv_path, now()->addMinutes(30));
    }
}
