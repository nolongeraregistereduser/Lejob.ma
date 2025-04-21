@extends('layouts.app')

@section('title', 'Create CV')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Create Your Professional CV</h1>
    <div id="cv-builder-app" class="bg-white rounded-lg shadow p-6"></div>
</div>
@endsection

@push('scripts')
    @viteReactRefresh
    @vite(['resources/js/App.jsx'])
@endpush