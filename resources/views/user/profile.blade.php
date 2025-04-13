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
                
                <!-- SKILLS Section -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-sm font-bold uppercase text-gray-700 tracking-wider">COMPÉTENCES</h3>
                        <button type="button" class="text-purple-600 text-sm font-medium flex items-center hover:text-purple-700 transition-colors">
                            <span class="mr-1">+</span> Ajouter de nouvelles compétences
                        </button>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium">Programmation</span>
                                <span class="text-sm font-semibold">78%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-purple-600 h-2.5 rounded-full" style="width: 78%"></div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="text-sm font-medium">Prototypage</span>
                                <span class="text-sm font-semibold">65%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-purple-600 h-2.5 rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tool Icons -->
                <div class="mt-8 flex flex-wrap gap-2">
                    <button type="button" class="p-3 bg-blue-500 text-white rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button type="button" class="p-3 bg-white border-2 border-gray-200 rounded-full flex items-center justify-center hover:border-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 3a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2H5zm0 2h10v7h-2l-1 2H8l-1-2H5V5z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button type="button" class="p-3 bg-white border-2 border-gray-200 rounded-full hover:border-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a2 2 0 00-2 2v11a3 3 0 106 0V4a2 2 0 00-2-2H4zm1 14a1 1 0 100-2 1 1 0 000 2zm5-1.757l4.9-4.9a2 2 0 000-2.828L13.485 5.1a2 2 0 00-2.828 0L10 5.757v8.486zM16 18H9.071l6-6H16a2 2 0 012 2v2a2 2 0 01-2 2z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button type="button" class="p-3 bg-white border-2 border-gray-200 rounded-full hover:border-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </button>
                    <button type="button" class="p-3 bg-white border-2 border-gray-200 rounded-full hover:border-gray-300 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                    </button>
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
                            <div class="relative w-16 h-16">
                                <svg class="w-full h-full" viewBox="0 0 36 36">
                                    <circle cx="18" cy="18" r="16" fill="none" stroke="#E5E7EB" stroke-width="3"/>
                                    <circle cx="18" cy="18" r="16" fill="none" stroke="#F97316" stroke-width="3" stroke-dasharray="66, 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"/>
                                    <text x="18" y="20" class="text-xs font-semibold text-center" text-anchor="middle">66%</text>
                                </svg>
                                <span class="block text-center text-xs mt-1">PHP</span>
                            </div>
                            <div class="relative w-16 h-16">
                                <svg class="w-full h-full" viewBox="0 0 36 36">
                                    <circle cx="18" cy="18" r="16" fill="none" stroke="#E5E7EB" stroke-width="3"/>
                                    <circle cx="18" cy="18" r="16" fill="none" stroke="#22C55E" stroke-width="3" stroke-dasharray="31, 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"/>
                                    <text x="18" y="20" class="text-xs font-semibold text-center" text-anchor="middle">31%</text>
                                </svg>
                                <span class="block text-center text-xs mt-1">Vue</span>
                            </div>
                            <div class="relative w-16 h-16">
                                <svg class="w-full h-full" viewBox="0 0 36 36">
                                    <circle cx="18" cy="18" r="16" fill="none" stroke="#E5E7EB" stroke-width="3"/>
                                    <circle cx="18" cy="18" r="16" fill="none" stroke="#14B8A6" stroke-width="3" stroke-dasharray="7, 100" stroke-dashoffset="0" transform="rotate(-90 18 18)"/>
                                    <text x="18" y="20" class="text-xs font-semibold text-center" text-anchor="middle">7%</text>
                                </svg>
                                <span class="block text-center text-xs mt-1">Laravel</span>
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
                        <a href="/mohammed.portfolio" class="flex items-center p-2 hover:bg-gray-50 rounded-md">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold">f</span>
                            </div>
                            <span>/mohammed.portfolio</span>
                        </a>
                        
                        <a href="/mohammed.drib" class="flex items-center p-2 hover:bg-gray-50 rounded-md">
                            <div class="w-8 h-8 bg-pink-500 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold">d</span>
                            </div>
                            <span>/mohammed.drib</span>
                        </a>
                        
                        <a href="/mohammed.in" class="flex items-center p-2 hover:bg-gray-50 rounded-md">
                            <div class="w-8 h-8 bg-blue-700 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold">in</span>
                            </div>
                            <span>/mohammed.in</span>
                        </a>
                        
                        <a href="/mohammedalaoui" class="flex items-center p-2 hover:bg-gray-50 rounded-md">
                            <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center mr-3">
                                <span class="text-white font-bold">yt</span>
                            </div>
                            <span>/mohammedalaoui</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
