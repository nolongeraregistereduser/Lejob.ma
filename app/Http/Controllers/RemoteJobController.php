<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class RemoteJobController extends Controller
{
    /**
     * Fetch remote jobs from Remotive API and display them with pagination
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        try {
            // Fetch all jobs from API (unfortunately Remotive API doesn't support pagination params)
            $response = Http::get('https://remotive.com/api/remote-jobs');
            
            if ($response->successful()) {
                $jobsData = $response->json();
                $allJobs = $jobsData['jobs'] ?? [];
                $totalJobs = count($allJobs);
                
                // Handle pagination manually
                $perPage = 21; // Number of jobs per page
                $currentPage = $request->query('page', 1);
                
                // Slice the array to get only the jobs for current page
                $currentPageJobs = array_slice($allJobs, ($currentPage - 1) * $perPage, $perPage);
                
                // Create a custom paginator
                $jobs = new LengthAwarePaginator(
                    $currentPageJobs, 
                    $totalJobs, 
                    $perPage, 
                    $currentPage, 
                    ['path' => $request->url(), 'query' => $request->query()]
                );
                
                return view('jobs.remote', [
                    'jobs' => $jobs,
                    'jobsCount' => $totalJobs,
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