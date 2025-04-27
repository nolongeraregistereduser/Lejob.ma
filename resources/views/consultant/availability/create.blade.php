@extends('layouts.app')

@section('title', 'Ajouter une disponibilité')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-sm">
        <h1 class="text-2xl font-semibold mb-6">Ajouter une plage horaire disponible</h1>
        
        <form action="{{ route('consultant.availability.store') }}" method="POST">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="date">
                    Date
                </label>
                <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    id="date" type="date" name="date" min="{{ date('Y-m-d') }}" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="start_time">
                    Heure de début
                </label>
                <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    id="start_time" type="time" name="start_time" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="end_time">
                    Heure de fin
                </label>
                <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    id="end_time" type="time" name="end_time" required>
            </div>
            
            <div class="flex items-center justify-between">
                <a href="{{ route('consultant.availability.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Annuler
                </a>
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Ajouter la disponibilité
                </button>
            </div>
        </form>
    </div>
</div>
@endsection