<!-- filepath: resources/views/user/feedback/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Laisser un avis sur votre séance</h2>
                    <p class="text-gray-600 mt-1">Votre feedback nous aidera à améliorer nos services et guidera d'autres utilisateurs.</p>
                </div>

                <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <img class="h-12 w-12 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($reservation->consultant->name) }}&size=48&background=0D8ABC&color=fff" alt="{{ $reservation->consultant->name }}">
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ $reservation->consultant->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $reservation->consultant->speciality ?? 'Consultant de Carrière' }}</p>
                            <div class="mt-1 flex items-center">
                                <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span class="ml-1 text-sm text-gray-500">
                                    Séance du {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('user.feedback.store', $reservation) }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Notation <span class="text-red-500">*</span>
                        </label>
                        <div class="flex items-center">
                            <div class="flex items-center space-x-1" x-data="{ rating: 5 }">
                                @for($i = 1; $i <= 5; $i++)
                                <button type="button" 
                                        @click="rating = {{ $i }}; document.getElementById('rating').value = {{ $i }}"
                                        x-bind:class="{ 'text-yellow-400': rating >= {{ $i }}, 'text-gray-300': rating < {{ $i }} }"
                                        class="focus:outline-none">
                                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </button>
                                @endfor
                                <input type="hidden" name="rating" id="rating" value="5">
                            </div>
                            <span class="ml-2 text-sm text-gray-600" x-text="rating + ' étoile' + (rating > 1 ? 's' : '')">5 étoiles</span>
                        </div>
                        @error('rating')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6">
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                            Commentaire
                        </label>
                        <textarea id="comment" name="comment" rows="4" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('comment') border-red-500 @enderror"
                                  placeholder="Partagez votre expérience avec ce consultant...">{{ old('comment') }}</textarea>
                        @error('comment')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-end">
                        <a href="{{ route('user.reservations.index') }}" class="mr-4 px-4 py-2 border border-gray-300 rounded-md font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Annuler
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Soumettre l'avis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection