<?php

namespace App\Http\Controllers;

use App\Models\JobOffer;
use Illuminate\Http\Request;

class JobOfferController extends Controller
{
    public function index()
    {
        $jobOffers = JobOffer::all();
        return view('backend.job_offers.index', compact('jobOffers'));
    }

    public function create()
    {
        return view('backend.job_offers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        JobOffer::create($request->all());

        return redirect()->route('job_offers.index')->with('success', 'Job offer created successfully.');
    }

    public function show(JobOffer $jobOffer)
    {
        return view('backend.job_offers.show', compact('jobOffer'));
    }

    public function edit(JobOffer $jobOffer)
    {
        return view('backend.job_offers.edit', compact('jobOffer'));
    }

    public function update(Request $request, JobOffer $jobOffer)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $jobOffer->update($request->all());

        return redirect()->route('job_offers.index')->with('success', 'Job offer updated successfully.');
    }

    public function destroy(JobOffer $jobOffer)
    {
        $jobOffer->delete();

        return redirect()->route('job_offers.index')->with('success', 'Job offer deleted successfully.');
    }
}
