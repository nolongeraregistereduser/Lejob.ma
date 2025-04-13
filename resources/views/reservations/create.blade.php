<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Réserver une session - LeJob.ma</title>
    
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
                <h1 class="crafty-font text-3xl mb-8 text-center">Réserver une session avec {{ $consultant->name }}</h1>
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-center mb-8">
                            <img 
                                src="{{ $consultant->profile_picture ? asset('storage/' . $consultant->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($consultant->name) . '&background=random' }}" 
                                alt="{{ $consultant->name }}" 
                                class="w-16 h-16 rounded-full mr-4 object-cover"
                            >
                            <div>
                                <h2 class="font-bold text-xl">{{ $consultant->name }}</h2>
                                <p class="text-gray-600">{{ $consultant->title }}</p>
                            </div>
                        </div>
                        
                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                                {{ session('error') }}
                            </div>
                        @endif
                        
                        <form action="{{ route('reservations.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="consultant_id" value="{{ $consultant->id }}">
                            
                            <div class="mb-6">
                                <label for="date" class="block text-gray-700 font-medium mb-2">Date</label>
                                <input 
                                    type="date" 
                                    id="date" 
                                    name="date" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                >
                                @error('date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="availability_id" class="block text-gray-700 font-medium mb-2">Horaire disponible</label>
                                <select 
                                    id="availability_id" 
                                    name="availability_id" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
                                    required
                                >
                                    <option value="">Sélectionnez un horaire</option>
                                    @foreach($availabilities as $availability)
                                        <option value="{{ $availability->id }}">
                                            {{ $availability->day_name }} : {{ $availability->time_range }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('availability_id')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="topic" class="block text-gray-700 font-medium mb-2">Sujet de la consultation</label>
                                <select 
                                    id="topic" 
                                    name="topic" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
                                    required
                                >
                                    <option value="">Sélectionnez un sujet</option>
                                    <option value="CV Review">Révision de CV</option>
                                    <option value="Career Advice">Conseil de carrière</option>
                                    <option value="Interview Preparation">Préparation d'entretien</option>
                                    <option value="Job Search Strategy">Stratégie de recherche d'emploi</option>
                                    <option value="Other">Autre</option>
                                </select>
                                @error('topic')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="notes" class="block text-gray-700 font-medium mb-2">Notes supplémentaires</label>
                                <textarea 
                                    id="notes" 
                                    name="notes" 
                                    rows="4" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black"
                                    placeholder="Décrivez brièvement ce que vous souhaitez aborder lors de cette session..."
                                ></textarea>
                                @error('notes')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800 transition-colors">
                                    Confirmer la réservation
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')
</body>
</html>