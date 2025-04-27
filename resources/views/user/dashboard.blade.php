@extends('layouts.app')

@section('title', 'User Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- CV Status Card -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Your CV</h3>
            <svg class="h-8 w-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>
        <p class="text-gray-500 mb-4">Create or update your professional CV</p>
        <a href="{{ route('cv.create') }}" class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
            Create CV
        </a>
    </div>

    <!-- Job Applications Card -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Job Applications</h3>
            <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
        <p class="text-gray-500 mb-4">Track your job applications</p>
        <div class="flex justify-between text-sm mb-4">
            <div>
                <span class="block text-2xl font-bold text-gray-800">0</span>
                <span class="text-gray-500">Applied</span>
            </div>
            <div>
                <span class="block text-2xl font-bold text-gray-800">0</span>
                <span class="text-gray-500">In Review</span>
            </div>
            <div>
                <span class="block text-2xl font-bold text-gray-800">0</span>
                <span class="text-gray-500">Interviews</span>
            </div>
        </div>
        <a href="" class="block text-center bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
            Find Jobs
        </a>
    </div>

    <!-- Upcoming Consultations Card -->
    <div class="bg-white p-6 rounded-lg shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold">Consultations</h3>
            <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
        <p class="text-gray-500 mb-4">Schedule career consultations</p>
        <div class="mb-4">
            <p class="text-sm text-gray-500">No upcoming consultations</p>
        </div>
        <a href="{{ route('consultants.index') }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
            Book Consultation
        </a>
    </div>

    <!-- Recent Job Listings -->
    <div class="md:col-span-2 lg:col-span-3 bg-white p-6 rounded-lg shadow-sm">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold">Recent Job Opportunities</h3>
            <a href="" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View All</a>
        </div>
        
        <div class="border-t border-gray-200 divide-y divide-gray-200">
            <div class="py-4">
                <p class="text-gray-500 text-center py-8">No job listings available yet.</p>
            </div>
        </div>
    </div>
</div>
@endsection