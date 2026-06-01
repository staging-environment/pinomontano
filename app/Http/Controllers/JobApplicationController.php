<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function store(Request $request, JobOffer $jobOffer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'nullable|string|max:255',
            'cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'nullable|string',
        ]);

        $cvPath = $request->file('cv')->store('cvs', 'public');

        JobApplication::create([
            'job_offer_id' => $jobOffer->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cv_path' => $cvPath,
            'cover_letter' => $request->cover_letter,
        ]);

        return redirect()->back()->with('success', 'Your application has been submitted successfully.');
    }

    public function index(JobOffer $jobOffer)
    {
        $applications = $jobOffer->applications;
        return view('backend.job_applications.index', compact('jobOffer', 'applications'));
    }
}
