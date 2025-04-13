<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Détails de la Réservation - LeJob.ma</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Crafty+Girls&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
    <style>
        .crafty-font {
            font-family: 'Crafty Girls', cursive;
        }
    </style>
</head>
<body class="font-[Quicksand] bg-gray-50">
    @include('components.navbar')

    <main>
        <section class="px-6 py-12">
            <div class="max-w-4xl mx-auto">
                <div class="flex items-center mb-8">
                    <a href="{{ route('reservations.index') }}" class="text-gray-600 hover:text-black mr-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>
                    <h1 class="crafty-font text-3xl">Détails de la Réservation</h1>
                </div>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-8">
                        <div class="flex flex-col md:flex-row md:items-start gap-8">
                            <!-- Left: Consultant Info -->
                            <div class="md:w-1/3">
                                <div class="text-center md:text-left">
                                    <img 
                                        src="{{ $reservation->consultant->profile_picture ? asset('storage/' . $reservation->consultant->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($reservation->consultant->name) . '&background=random&size=150' }}" 
                                        alt="{{ $reservation->consultant->name }}" 
                                        class="w-32 h-32 rounded-full mx-auto md:mx-0 object-cover mb-4"
                                    >
                                    <h2 class="font-bold text-xl">{{ $reservation->consultant->name }}</h2>
                                    <p class="text-gray-600 mb-4">{{ $reservation->consultant->title }}</p>
                                    
                                    <div class="flex items-center justify-center md:justify-start mb-4">
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="ml-1 text-gray-600">
                                            {{ number_format($reservation->consultant->feedback->avg('rating') ?: 0, 1) }} 
                                            ({{ $reservation->consultant->feedback->count() }} avis)
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Right: Reservation Details -->
                            <div class="md:w-2/3">
                                <div class="mb-6">
                                    <h3 class="font-bold text-lg mb-3">Détails de la session</h3>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-gray-500 text-sm">Date</p>
                                            <p class="font-medium">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</p>
                                        </div>
                                        
                                        <div>
                                            <p class="text-gray-500 text-sm">Heure</p>
                                            <p class="font-medium">
                                                {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}
                                            </p>
                                        </div>
                                        
                                        <div>
                                            <p class="text-gray-500 text-sm">Sujet</p>
                                            <p class="font-medium">{{ $reservation->topic }}</p>
                                        </div>
                                        
                                        <div>
                                            <p class="text-gray-500 text-sm">Statut</p>
                                            <p>
                                                @if($reservation->status == 'pending')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        En attente
                                                    </span>
                                                @elseif($reservation->status == 'confirmed')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Confirmée
                                                    </span>
                                                @elseif($reservation->status == 'completed')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        Terminée
                                                    </span>
                                                @elseif($reservation->status == 'cancelled')
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Annulée
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                @if($reservation->notes)
                                    <div class="mb-6">
                                        <h3 class="font-bold text-lg mb-3">Notes</h3>
                                        <p class="text-gray-700 whitespace-pre-line">{{ $reservation->notes }}</p>
                                    </div>
                                @endif
                                
                                <div class="flex justify-between items-center">
                                    @if($reservation->status == 'pending' || $reservation->status == 'confirmed')
                                        <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-full hover:bg-red-700 transition-colors" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation?')">
                                                Annuler la réservation
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if($reservation->status == 'confirmed')
                                        <div class="text-right">
                                            <p class="text-sm text-gray-500 mb-1">Lien de la réunion</p>
                                            <a href="{{ $reservation->meeting_link ?? '#' }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium">
                                                {{ $reservation->meeting_link ?? 'Pas encore disponible' }}
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Feedback Section -->
                @if($reservation->status == 'completed')
                    <div id="feedback" class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-8">
                            <h2 class="font-bold text-xl mb-6">Votre avis sur cette session</h2>
                            
                            @if($reservation->feedback)
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <div class="flex items-center mb-4">
                                        <div class="flex">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg class="w-5 h-5 {{ $i <= $reservation->feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endfor
                                            <span class="ml-2 text-gray-600">{{ $reservation->feedback->rating }}/5</span>
                                        </div>
                                        <span class="mx-4 text-gray-300">|</span>
                                        <span class="text-gray-500 text-sm">{{ $reservation->feedback->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    
                                    <p class="text-gray-700 mb-4">{{ $reservation->feedback->comment }}</p>
                                    
                                    <div class="flex justify-end">
                                        <button type="button" id="editFeedbackBtn" class="text-indigo-600 hover:text-indigo-900">
                                            Modifier mon avis
                                        </button>
                                    </div>
                                </div>
                                
                                <form action="{{ route('feedback.update', $reservation->feedback->id) }}" method="POST" id="editFeedbackForm" class="hidden mt-6">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Note</label>
                                        <div class="flex">
                                            <div class="flex items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <input type="radio" id="rating{{ $i }}" name="rating" value="{{ $i }}" class="hidden" {{ $reservation->feedback->rating == $i ? 'checked' : '' }}>
                                                    <label for="rating{{ $i }}" class="cursor-pointer">
                                                        <svg class="w-8 h-8 {{ $i <= $reservation->feedback->rating ? 'text-yellow-400' : 'text-gray-300' }} star-rating" data-rating="{{ $i }}" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>
                                        @error('rating')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="comment" class="block text-gray-700 font-medium mb-2">Commentaire</label>
                                        <textarea 
                                            id="comment" 
                                            name="comment" 
                                            rows="4" 
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
                                            required
                                        >{{ $reservation->feedback->comment }}</textarea>
                                        @error('comment')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="is_public" class="rounded border-gray-300 text-black focus:ring-black" {{ $reservation->feedback->is_public ? 'checked' : '' }}>
                                            <span class="ml-2 text-gray-700">Rendre cet avis public sur le profil du consultant</span>
                                        </label>
                                    </div>
                                    
                                    <div class="flex justify-end">
                                        <button type="button" id="cancelEditBtn" class="text-gray-600 hover:text-gray-900 mr-4">
                                            Annuler
                                        </button>
                                        <button type="submit" class="bg-black text-white px-4 py-2 rounded-full hover:bg-gray-800 transition-colors">
                                            Mettre à jour
                                        </button>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('feedback.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                                    
                                    <div class="mb-4">
                                        <label class="block text-gray-700 font-medium mb-2">Note</label>
                                        <div class="flex">
                                            <div class="flex items-center">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <input type="radio" id="rating{{ $i }}" name="rating" value="{{ $i }}" class="hidden" {{ old('rating') == $i ? 'checked' : '' }}>
                                                    <label for="rating{{ $i }}" class="cursor-pointer">
                                                        <svg class="w-8 h-8 text-gray-300 star-rating" data-rating="{{ $i }}" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>
                                        @error('rating')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="comment" class="block text-gray-700 font-medium mb-2">Commentaire</label>
                                        <textarea 
                                            id="comment" 
                                            name="comment" 
                                            rows="4" 
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
                                            placeholder="Partagez votre expérience avec ce consultant..."
                                            required
                                        >{{ old('comment') }}</textarea>
                                        @error('comment')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" name="is_public" class="rounded border-gray-300 text-black focus:ring-black" {{ old('is_public') ? 'checked' : 'checked' }}>
                                            <span class="ml-2 text-gray-700">Rendre cet avis public sur le profil du consultant</span>
                                        </label>
                                    </div>
                                    
                                    <div class="flex justify-end">
                                        <button type="submit" class="bg-black text-white px-4 py-2 rounded-full hover:bg-gray-800 transition-colors">
                                            Soumettre mon avis
                                        </button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>

    @include('components.footer')

    <script>
        // Star rating functionality
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating');
            
            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    const rating = this.dataset.rating;
                    highlightStars(rating);
                });
                
                star.addEventListener('click', function() {
                    const rating = this.dataset.rating;
                    document.getElementById('rating' + rating).checked = true;
                    highlightStars(rating);
                });
            });
            
            // Find all star containers and add mouseout event
            const starContainers = document.querySelectorAll('.flex.items-center');
            starContainers.forEach(container => {
                if (container.querySelector('.star-rating')) {
                    container.addEventListener('mouseout', function() {
                        resetStars();
                        
                        // Find the checked radio button and highlight stars accordingly
                        const checkedRadio = document.querySelector('input[name="rating"]:checked');
                        if (checkedRadio) {
                            highlightStars(checkedRadio.value);
                        }
                    });
                }
            });
            
            function highlightStars(rating) {
                stars.forEach(star => {
                    if (star.dataset.rating <= rating) {
                        star.classList.add('text-yellow-400');
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-gray-300');
                        star.classList.remove('text-yellow-400');
                    } else {
                        star.classList.add('text-gray-300');
                        star.classList.remove('text-yellow-400');
                    }
                });
            }
            
            function resetStars() {
                stars.forEach(star => {
                    star.classList.add('text-gray-300');
                    star.classList.remove('text-yellow-400');
                });
            }
            
            // Initialize stars based on existing ratings
            const checkedRadio = document.querySelector('input[name="rating"]:checked');
            if (checkedRadio) {
                highlightStars(checkedRadio.value);
            }
            
            // Edit feedback toggle
            const editFeedbackBtn = document.getElementById('editFeedbackBtn');
            const editFeedbackForm = document.getElementById('editFeedbackForm');
            const cancelEditBtn = document.getElementById('cancelEditBtn');
            
            if (editFeedbackBtn && editFeedbackForm && cancelEditBtn) {
                editFeedbackBtn.addEventListener('click', function() {
                    const feedbackDisplay = document.querySelector('.bg-gray-50.p-6.rounded-lg');
                    if (feedbackDisplay) {
                        feedbackDisplay.classList.add('hidden');
                        editFeedbackForm.classList.remove('hidden');
                    }
                });
                
                cancelEditBtn.addEventListener('click', function() {
                    const feedbackDisplay = document.querySelector('.bg-gray-50.p-6.rounded-lg');
                    if (feedbackDisplay) {
                        feedbackDisplay.classList.remove('hidden');
                        editFeedbackForm.classList.add('hidden');
                    }
                });
            }
        });
    </script>