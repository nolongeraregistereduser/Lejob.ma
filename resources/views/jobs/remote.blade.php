@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Remote Jobs</h1>
                
                @if(isset($error))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
                        <p>{{ $error }}</p>
                    </div>
                @endif
                
                <p class="mb-4">Found {{ $jobsCount }} remote jobs</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($jobs as $job)
                        <div class="border rounded-lg p-4 hover:shadow-md transition">
                            <div class="flex items-center mb-3">
                                @if(isset($job['company_logo']))
                                    <img src="{{ $job['company_logo'] }}" alt="{{ $job['company_name'] }} logo" class="h-10 w-10 object-contain mr-3">
                                @else
                                    <div class="h-10 w-10 bg-gray-200 rounded-full mr-3 flex items-center justify-center">
                                        <span class="text-gray-500">{{ substr($job['company_name'] ?? 'CO', 0, 2) }}</span>
                                    </div>
                                @endif
                                <h3 class="font-medium text-lg">{{ $job['title'] ?? 'Unknown Position' }}</h3>
                            </div>
                            
                            <p class="text-sm text-gray-600 mb-2">{{ $job['company_name'] ?? 'Unknown Company' }}</p>
                            <p class="text-sm text-gray-600 mb-2">Category: {{ $job['category'] ?? 'Not specified' }}</p>
                            <p class="text-sm text-gray-600 mb-4">Location: {{ $job['candidate_required_location'] ?? 'Remote' }}</p>
                            
                            <a href="{{ $job['url'] ?? '#' }}" target="_blank" 
                               class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                                View Job
                            </a>
                        </div>
                    @empty
                        <div class="col-span-3">
                            <p>No remote jobs found at this time.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection