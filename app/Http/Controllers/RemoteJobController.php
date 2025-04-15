<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RemoteJobController extends Controller
{
    /**
     * Fetch remote jobs from Remotive API and display them
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $response = Http::get('https://remotive.com/api/remote-jobs');
            
            if ($response->successful()) {
                $jobsData = $response->json();
                
                return view('jobs.remote', [
                    'jobs' => $jobsData['jobs'] ?? [],
                    'jobsCount' => $jobsData['job-count'] ?? 0,
                ]);
            }
            
            return view('jobs.remote', [
                'jobs' => [],
                'jobsCount' => 0,
                'error' => 'Unable to fetch jobs. API returned status: ' . $response->status()
            ]);
            
        } catch (\Exception $e) {
            Log::error('Failed to fetch remote jobs: ' . $e->getMessage());
            
            return view('jobs.remote', [
                'jobs' => [],
                'jobsCount' => 0,
                'error' => 'Unable to connect to the remote jobs API. Please try again later.'
            ]);
        }
    }
}