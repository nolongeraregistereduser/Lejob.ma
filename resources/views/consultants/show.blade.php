@extends('layouts.app')

@section('title', $consultant->name . ' - Consultant')

@section('content')
<div class="container mx-auto py-8">
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="p-6 md:p-8 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center">
                <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                    @if($consultant->profile_picture)
                        <img class="h-32 w-32 object-cover rounded-full" src="{{ asset('storage/' . $consultant->profile_picture) }}" alt="{{ $consultant->name }}">
                    @else
                        <div class="h-32 w-32 rounded-full bg-gray-300 flex items-center justify-center">
                            <svg class="h-16 w-16 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex-grow">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $consultant->name }}</h1>
                    <p class="text-xl text-gray-600">{{ $consultant->title ?? 'Consultant Carrière' }}</p>
                    
                    <div class="mt-2 flex items-center">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= round($averageRating))
                                    <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @else
                                    <svg class="h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endif
                            @endfor
                            <span class="ml-2 text-gray-600 text-sm">({{ $consultant->feedbacks->count() }} avis)</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex flex-wrap items-center gap-4">
                        @if($consultant->linkedin)
                            <a href="{{ $consultant->linkedin }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                        @endif
                        @if($consultant->website)
                            <a href="{{ $consultant->website }}" target="_blank" class="text-gray-600 hover:text-gray-800">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm1 16.057v-3.057h2.994c-.059 1.143-.212 2.24-.456 3.279-.823-.12-1.674-.188-2.538-.222zm1.957 2.162c-.499 1.33-1.159 2.497-1.957 3.456v-3.62c.666.028 1.319.081 1.957.164zm-1.957-7.219v-3.015c.868-.034 1.721-.103 2.548-.224.238 1.027.389 2.111.446 3.239h-2.994zm0-5.014v-3.661c.806.969 1.471 2.15 1.971 3.496-.642.084-1.3.137-1.971.165zm2.703-3.267c1.237.496 2.354 1.228 3.29 2.146-.642.234-1.311.442-2.019.607-.344-.992-.775-1.91-1.271-2.753zm-7.241 13.56c-.244-1.039-.398-2.136-.456-3.279h2.994v3.057c-.865.034-1.714.102-2.538.222zm2.538 1.776v3.62c-.798-.959-1.458-2.126-1.957-3.456.638-.083 1.291-.136 1.957-.164zm-2.994-7.055c.057-1.128.207-2.212.446-3.239.827.121 1.68.19 2.548.224v3.015h-2.994zm1.024-5.179c.5-1.346 1.165-2.527 1.97-3.496v3.661c-.671-.028-1.329-.081-1.97-.165zm-2.005-.35c-.708-.165-1.377-.373-2.018-.607.937-.918 2.053-1.65 3.29-2.146-.496.844-.927 1.762-1.272 2.753zm-.549 1.918c-.264 1.151-.434 2.36-.492 3.611h-3.933c.165-1.658.739-3.197 1.617-4.518.88.361 1.816.67 2.808.907zm.009 9.262c-.988.236-1.92.542-2.797.9-.89-1.328-1.471-2.879-1.637-4.551h3.934c.058 1.265.231 2.488.5 3.651zm.553 1.917c.342.976.768 1.881 1.257 2.712-1.223-.49-2.326-1.211-3.256-2.115.636-.229 1.299-.435 1.999-.597zm9.924 0c.7.163 1.362.367 1.999.597-.931.903-2.034 1.625-3.257 2.116.489-.832.915-1.737 1.258-2.713zm.553-1.917c.27-1.163.442-2.386.501-3.651h3.934c-.167 1.672-.748 3.223-1.638 4.551-.877-.358-1.81-.664-2.797-.9zm.501-5.651c-.058-1.251-.229-2.46-.492-3.611.992-.237 1.929-.546 2.809-.907.877 1.321 1.451 2.86 1.616 4.518h-3.933z"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-6 md:p-8 border-b border-gray-200">
            <h2 class="text-xl font-semibold mb-4">À propos</h2>
            <p class="text-gray-700">{{ $consultant->bio ?? 'Aucune information disponible.' }}</p>
        </div>
        
        <div class="p-6 md:p-8">
            <h2 class="text-xl font-semibold mb-6">Disponibilités</h2>
            
            @if($consultant->availableTimeSlots->count() > 0)
                <div class="space-y-4">
                    @foreach($consultant->availableTimeSlots()->get() as $availability)
                        <div class="border border-gray-200 rounded-lg p-4 flex justify-between items-center">
                            <div>
                                <p class="font-medium">{{ $availability->getFormattedSlot() }}</p>
                            </div>
                            
                            @auth
                                <form action="{{ route('user.book-session') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="consultant_id" value="{{ $consultant->id }}">
                                    <input type="hidden" name="availability_id" value="{{ $availability->id }}">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                        Réserver une session
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                    Se connecter pour réserver
                                </a>
                            @endauth
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 border border-gray-200 rounded-lg">
                    <p class="text-gray-500">Aucune disponibilité pour le moment.</p>
                    <p class="text-sm text-gray-400 mt-2">Merci de vérifier ultérieurement.</p>
                </div>
            @endif
        </div>
        
        @if($consultant->feedbacks->count() > 0)
            <div class="p-6 md:p-8 border-t border-gray-200">
                <h2 class="text-xl font-semibold mb-6">Avis récents</h2>
                
                <div class="space-y-4">
                    @foreach($consultant->feedbacks as $feedback)
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $feedback->rating)
                                            <svg class="h-4 w-4 text-yellow-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @else
                                            <svg class="h-4 w-4 text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endif
                                    @endfor
                                </div>
                                <span class="ml-2 text-sm text-gray-500">{{ $feedback->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-600">{{ $feedback->comment }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection