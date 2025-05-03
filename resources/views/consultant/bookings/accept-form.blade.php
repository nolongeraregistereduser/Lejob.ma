<!-- filepath: c:\Users\LENOVO\Desktop\Desktop FIL ROUGE\Lejob.ma\resources\views\consultant\bookings\accept-form.blade.php -->
@extends('layouts.consultant')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('consultant.bookings') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Retour aux réservations
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-xl font-bold text-gray-800">Confirmer la réservation</h2>
        </div>
        
        <div class="p-6">
            <div class="mb-6">
                <h3 class="text-lg font-medium text-gray-900 mb-3">Détails de la réservation</h3>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Client:</p>
                            <p class="font-medium">{{ $reservation->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Email:</p>
                            <p class="font-medium">{{ $reservation->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Date:</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Heure:</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('consultant.bookings.accept', $reservation->id) }}" method="POST">
                @csrf
                
                <div class="mb-6">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                        Instructions pour le client <span class="text-red-600">*</span>
                    </label>
                    <p class="text-sm text-gray-500 mb-2">Incluez les détails de connexion (lien Zoom/Google Meet), instructions spécifiques ou toute autre information utile.</p>
                    <textarea id="notes" name="notes" rows="6" required class="block w-full rounded-md border border-gray-300 shadow-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('consultant.bookings') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Annuler
                    </a>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Confirmer la réservation
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection