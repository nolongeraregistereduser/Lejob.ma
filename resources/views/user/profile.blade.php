@extends('layouts.app')

@section('title', 'Modifier le Profil')
@section('page-title', 'Modifier le Profil')

@section('content')
@if(session('success'))
    <!-- success message display -->
@endif

@if(session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
        <p>{{ session('error') }}</p>
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold">Modifier le Profil</h2>
        <div class="flex space-x-2">
            <button type="button" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors">Annuler</button>
            <button type="submit" form="profile-form" class="px-4 py-2 bg-purple-600 text-white rounded-full hover:bg-purple-700 transition-colors">Enregistrer</button>
        </div>
    </div>

    <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <!-- Case à cocher déplacée à l'intérieur du formulaire -->
        <div class="flex items-center mb-6">
            <span class="mr-2 text-sm text-gray-600 font-medium">Disponible pour embauche?</span>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="available_for_hire" class="sr-only peer" {{ $user->available_for_hire ?? false ? 'checked' : '' }}>
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
            </label>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Left column - Form fields (wider) -->
            <div class="lg:col-span-3">
                <!-- GENERALS Section -->
                <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-sm font-bold uppercase text-gray-700 mb-6 tracking-wider">INFORMATIONS GÉNÉRALES</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1.5">Prénom</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name ?? $user->name ?? '') }}" 
                                class="w-full h-12 border-2 border-gray-200 rounded-full px-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="Mohammed">
                        </div>
                        
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1.5">Nom de Famille</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name ?? '') }}" 
                                class="w-full h-12 border-2 border-gray-200 rounded-full px-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="El Alaoui">
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1.5">Nom d'utilisateur</label>
                            <input type="text" id="username" name="username" value="{{ old('username', $user->username ?? '') }}" 
                                class="w-full h-12 border-2 border-gray-200 rounded-full px-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="mohammed.alaoui">
                        </div>
                        
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1.5">Titre professionnel</label>
                            <input type="text" id="title" name="title" value="{{ old('title', $user->title ?? '') }}" 
                                class="w-full h-12 border-2 border-gray-200 rounded-full px-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="Développeur Web">
                        </div>
                        
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Mot de passe</label>
                            <input type="password" id="password" name="password" 
                                class="w-full h-12 border-2 border-gray-200 rounded-full px-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="**************">
                        </div>
                        
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Confirmer le mot de passe</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                class="w-full h-12 border-2 border-gray-200 rounded-full px-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="**************">
                        </div>
                    </div>
                </div>
                
                <!-- CONTACT Section -->
                <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-sm font-bold uppercase text-gray-700 mb-6 tracking-wider">CONTACT</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1.5">Téléphone Mobile</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                    </svg>
                                </div>
                                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" 
                                    class="w-full h-12 border-2 border-gray-200 rounded-full pl-10 pr-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="+212 6 61 23 45 67">
                            </div>
                        </div>
                        
                        <div>
                            <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-1.5">Whatsapp</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                        <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                                    </svg>
                                </div>
                                <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp ?? '') }}" 
                                    class="w-full h-12 border-2 border-gray-200 rounded-full pl-10 pr-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="+212 6 61 23 45 67">
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                    </svg>
                                </div>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" 
                                    class="w-full h-12 border-2 border-gray-200 rounded-full pl-10 pr-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="mohammed.alaoui@gmail.com">
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-1.5">Adresse</label>
                            <input type="text" id="address" name="address" value="{{ old('address', $user->address ?? '') }}" 
                                class="w-full h-12 border-2 border-gray-200 rounded-full px-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="Résidence Al Wafa, Apt 5, Rue Hassan II">
                        </div>
                        
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1.5">Ville</label>
                            <div class="relative">
                                <input type="text" id="city" name="city" value="{{ old('city', $user->city ?? '') }}" 
                                    class="w-full h-12 border-2 border-gray-200 rounded-full px-4 pr-10 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="Casablanca">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-1.5">Pays</label>
                            <div class="relative">
                                <input type="text" id="country" name="country" value="{{ old('country', $user->country ?? '') }}" 
                                    class="w-full h-12 border-2 border-gray-200 rounded-full px-4 pr-10 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="Maroc">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- ABOUT ME Section -->
                <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-sm font-bold uppercase text-gray-700 mb-6 tracking-wider">À PROPOS DE MOI</h3>
                    
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1.5">Parlez de vous</label>
                        <textarea id="bio" name="bio" rows="6" 
                            class="w-full border-2 border-gray-200 rounded-2xl px-4 py-3 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800 resize-none" placeholder="Décrivez votre parcours professionnel, vos compétences et vos objectifs...">{{ old('bio', $user->bio ?? '') }}</textarea>
                    </div>
                </div>
                
                <!-- SOCIAL LINKS Section (replacing SKILLS section) -->
                <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                    <h3 class="text-sm font-bold uppercase text-gray-700 mb-6 tracking-wider">LIENS SOCIAUX</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-1.5">LinkedIn</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </div>
                                <input type="text" id="linkedin" name="linkedin" value="{{ old('linkedin', $user->linkedin ?? '') }}" 
                                    class="w-full h-12 border-2 border-gray-200 rounded-full pl-10 pr-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="username">
                            </div>
                        </div>
                        
                        <div>
                            <label for="github" class="block text-sm font-medium text-gray-700 mb-1.5">GitHub</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                    </svg>
                                </div>
                                <input type="text" id="github" name="github" value="{{ old('github', $user->github ?? '') }}" 
                                    class="w-full h-12 border-2 border-gray-200 rounded-full pl-10 pr-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="username">
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="twitter" class="block text-sm font-medium text-gray-700 mb-1.5">Twitter/X</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </div>
                                <input type="text" id="twitter" name="twitter" value="{{ old('twitter', $user->twitter ?? '') }}" 
                                    class="w-full h-12 border-2 border-gray-200 rounded-full pl-10 pr-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="username">
                            </div>
                        </div>
                        
                        <div>
                            <label for="website" class="block text-sm font-medium text-gray-700 mb-1.5">Site Web Personnel</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="website" name="website" value="{{ old('website', $user->website ?? '') }}" 
                                    class="w-full h-12 border-2 border-gray-200 rounded-full pl-10 pr-4 py-2 bg-white focus:border-purple-500 focus:ring-0 focus:outline-none transition-colors text-gray-800" placeholder="https://monsite.com">
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            
            <!-- Right column - Profile preview (narrower) -->
            <div class="bg-white rounded-lg shadow-sm p-0 flex flex-col items-center">
                <!-- Profile card with border and shadow -->
                <div class="w-full bg-white rounded-lg border border-gray-100 shadow-sm overflow-hidden">
                    <!-- Profile header with avatar and progress ring -->
                    <div class="flex flex-col items-center pt-8 pb-4">
                        <div class="relative mb-3">
                            <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                                @if(isset($user->profile_picture))
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="text-gray-400 text-4xl">{{ substr($user->name ?? 'User', 0, 1) }}</div>
                                @endif
                            </div>
                            <!-- Purple circular progress indicator -->
                            <svg class="absolute top-0 left-0 w-24 h-24" viewBox="0 0 100 100">
                                <circle cx="50" cy="50" r="46" fill="none" stroke="#E5E7EB" stroke-width="8"/>
                                <circle cx="50" cy="50" r="46" fill="none" stroke="#7C3AED" stroke-width="8" stroke-dasharray="240, 360" stroke-dashoffset="0" transform="rotate(-90 50 50)"/>
                            </svg>
                            <input type="file" name="profile_picture" id="profile_picture" class="hidden">
                            <label for="profile_picture" class="absolute bottom-0 right-0 bg-white rounded-full p-1.5 shadow-md cursor-pointer hover:bg-gray-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </label>
                        </div>
                        
                        <h3 class="text-lg font-semibold text-center">{{ $user->name ?? 'Mohammed El Alaoui' }}</h3>
                        <p class="text-gray-500 text-center">{{ $user->title ?? 'Développeur Web' }}</p>
                    </div>
                    
                    <!-- Followers section with border -->
                    <div class="grid grid-cols-2 w-full border-t border-b border-gray-100">
                        <div class="text-center py-4 px-2">
                            <p class="font-bold text-lg">228</p>
                            <p class="text-sm text-gray-500">Abonnements</p>
                        </div>
                        <div class="text-center py-4 px-2 border-l border-gray-100">
                            <p class="font-bold text-lg">4,842</p>
                            <p class="text-sm text-gray-500">Abonnés</p>
                        </div>
                    </div>
                    
                    <!-- Contact info section -->
                    <div class="p-6 space-y-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                            </div>
                            <span>{{ $user->phone ?? '+212 6 61 23 45 67' }}</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <span>{{ $user->email ?? 'mohammed.alaoui@gmail.com' }}</span>
                        </div>
                    </div>
                    
                    <!-- Skills chart section with border -->
                    <div class="border-t border-gray-100 p-6">
                        <div class="flex items-center justify-center space-x-4">
                            <!-- Remove the skills charts and replace with social links summary -->
                            <div class="w-full">
                                <h4 class="text-sm font-semibold mb-3">Liens sociaux</h4>
                                <div class="space-y-2">
                                    @if($user->linkedin)
                                    <div class="flex items-center text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                        </svg>
                                        <span class="truncate">{{ $user->linkedin }}</span>
                                    </div>
                                    @endif
                                    @if($user->github)
                                    <div class="flex items-center text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-800 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                        </svg>
                                        <span class="truncate">{{ $user->github }}</span>
                                    </div>
                                    @endif
                                    @if($user->twitter)
                                    <div class="flex items-center text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                        </svg>
                                        <span class="truncate">{{ $user->twitter }}</span>
                                    </div>
                                    @endif
                                    @if($user->website)
                                    <div class="flex items-center text-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="truncate">{{ $user->website }}</span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Portfolios section in a separate card -->
                <div class="w-full bg-white rounded-lg border border-gray-100 shadow-sm mt-6 p-4">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-semibold">Portfolios</h3>
                        <button type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                            </svg>
                        </button>
                    </div>
                    
                    <div class="space-y-3">
                        @if($user->portfolio)
                            @php
                                $portfolioLinks = explode(',', $user->portfolio);
                            @endphp
                            
                            @foreach($portfolioLinks as $link)
                                @php
                                    $link = trim($link);
                                    $domain = parse_url($link, PHP_URL_HOST) ?? $link;
                                    $path = parse_url($link, PHP_URL_PATH) ?? '';
                                    $displayText = $domain . $path;
                                    
                                    // Determine icon based on domain
                                    $iconBg = 'bg-blue-500';
                                    $iconText = 'p';
                                    
                                    if(stripos($domain, 'linkedin') !== false) {
                                        $iconBg = 'bg-blue-700';
                                        $iconText = 'in';
                                    } elseif(stripos($domain, 'github') !== false) {
                                        $iconBg = 'bg-gray-800';
                                        $iconText = 'gh';
                                    } elseif(stripos($domain, 'dribbble') !== false || stripos($domain, 'drib') !== false) {
                                        $iconBg = 'bg-pink-500';
                                        $iconText = 'd';
                                    } elseif(stripos($domain, 'youtube') !== false || stripos($domain, 'yt') !== false) {
                                        $iconBg = 'bg-red-600';
                                        $iconText = 'yt';
                                    } elseif(stripos($domain, 'behance') !== false) {
                                        $iconBg = 'bg-blue-600';
                                        $iconText = 'be';
                                    } elseif(stripos($domain, 'twitter') !== false) {
                                        $iconBg = 'bg-blue-400';
                                        $iconText = 'tw';
                                    }
                                @endphp
                                
                                <a href="{{ $link }}" target="_blank" class="flex items-center p-2 hover:bg-gray-50 rounded-md">
                                    <div class="w-8 h-8 {{ $iconBg }} rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white font-bold">{{ $iconText }}</span>
                                    </div>
                                    <span class="truncate">{{ $displayText }}</span>
                                </a>
                            @endforeach
                        @else
                            <p class="text-gray-500 text-sm italic">Aucun lien de portfolio ajouté</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

