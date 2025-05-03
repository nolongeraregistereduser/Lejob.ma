<!-- filepath: c:\Users\LENOVO\Desktop\Desktop FIL ROUGE\Lejob.ma\resources\views\consultant\bookings\accept-form.blade.php -->
@extends('layouts.consultant')

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mb-5">
                <a href="{{ route('consultant.bookings') }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-900">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour aux réservations
                </a>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Confirmer la réservation</h2>
            
            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Détails de la réservation</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Client:</p>
                        <p class="mt-1">{{ $reservation->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email:</p>
                        <p class="mt-1">{{ $reservation->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date:</p>
                        <p class="mt-1">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Heure:</p>
                        <p class="mt-1">{{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }}</p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('consultant.bookings.accept', $reservation->id) }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                        Instructions pour le client <span class="text-red-600">*</span>
                    </label>
                    <p class="text-sm text-gray-500 mb-3">
                        Incluez les détails de connexion (lien Zoom/Google Meet) et toute autre information utile pour le client.
                    </p>
                    <textarea 
                        id="notes" 
                        name="notes" 
                        rows="6"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('notes') border-red-500 @enderror"
                        placeholder="Exemple: Voici le lien de notre réunion Zoom: https://zoom.us/j/123456789. Veuillez vous connecter 5 minutes avant l'heure prévue."
                        required
                    >{{ old('notes') }}</textarea>
                    
                    @error('notes')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex items-center justify-end">
                    <a href="{{ route('consultant.bookings') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-3">
                        Annuler
                    </a>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Confirmer la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection