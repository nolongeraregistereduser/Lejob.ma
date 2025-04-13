@extends('layouts.app')

@section('title', 'Profil Consultant')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-900">Mon Profil Professionnel</h1>
            <p class="mt-2 text-gray-600">Gérez vos informations personnelles et professionnelles</p>
        </div>
        
        {{-- @if(session('success'))
            <div class="mb-8 bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif --}}
        
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <form action="{{ route('consultant.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Profile Header -->
                <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-16 relative">
                    <div class="absolute bottom-0 left-0 w-full transform translate-y-1/2 flex justify-center">
                        <div class="relative">
                            <div class="w-32 h-32 rounded-full border-4 border-white bg-white overflow-hidden shadow-lg">
                                @if($user->profile_picture)
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100 text-gray-700 text-4xl font-bold">
                                        {{ substr($user->name ?? 'U', 0, 1) }}
                                    </div>
                                @endif
                            </div>
                            <label for="profile_picture" class="absolute bottom-0 right-0 bg-blue-600 text-white rounded-full p-2 cursor-pointer shadow-md hover:bg-blue-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                </svg>
                            </label>
                            <input id="profile_picture" type="file" name="profile_picture" class="hidden" />
                        </div>
                    </div>
                </div>
                
                <!-- Form Content -->
                <div class="pt-20 px-6 pb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Basic Information Section -->
                        <div class="md:col-span-2">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                Informations de base
                            </h2>
                        </div>
                        
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Nom complet</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email</label>
                            <input type="email" id="email" value="{{ $user->email }}" 
                                class="w-full px-4 py-2 border border-gray-200 rounded-lg bg-gray-50 text-gray-500" disabled>
                        </div>
                        
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="title">Titre professionnel</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $user->title) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="ex: Coach Carrière, Consultant RH">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Contact Information Section -->
                        <div class="md:col-span-2 mt-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                Coordonnées
                            </h2>
                        </div>
                        
                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="phone">Téléphone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="+212 6XX XXXXXX">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- WhatsApp -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="whatsapp">WhatsApp</label>
                            <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="+212 6XX XXXXXX">
                            @error('whatsapp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Location Section -->
                        <div class="md:col-span-2 mt-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                Localisation
                            </h2>
                        </div>
                        
                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="address">Adresse</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="Adresse complète">
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- City -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="city">Ville</label>
                            <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="Casablanca">
                            @error('city')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Country -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="country">Pays</label>
                            <input type="text" name="country" id="country" value="{{ old('country', $user->country ?? 'Maroc') }}" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            @error('country')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Bio Section -->
                        <div class="md:col-span-2 mt-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                                Biographie professionnelle
                            </h2>
                        </div>
                        
                        <!-- Bio -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1" for="bio">Parlez de votre expérience et vos spécialités</label>
                            <textarea name="bio" id="bio" rows="5" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" 
                                placeholder="Parlez de votre expérience, vos spécialités et ce que vous pouvez offrir aux clients...">{{ old('bio', $user->bio) }}</textarea>
                            @error('bio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="mt-10 flex justify-end">
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection