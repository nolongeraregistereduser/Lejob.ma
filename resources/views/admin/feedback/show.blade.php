<!-- filepath: c:\Users\LENOVO\Desktop\Desktop FIL ROUGE\Lejob.ma\resources\views\admin\feedback\show.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('admin.feedback.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Retour aux avis
            </a>
            <h1 class="text-2xl font-bold mt-2">Détail de l'avis #{{ $feedback->id }}</h1>
        </div>
        
        <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                Supprimer
            </button>
        </form>
    </div>
    
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Feedback Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium">Information de l'avis</h2>
                </div>
                <div class="p-6">
                    <div class="mb-6">
                        <div class="text-sm font-medium text-gray-500 mb-1">Note :</div>
                        <div class="flex items-center">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $feedback->rating)
                                        <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <div class="text-lg text-gray-700 ml-2">({{ $feedback->rating }}/5)</div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <div class="text-sm font-medium text-gray-500 mb-1">Commentaire :</div>
                        <div class="bg-gray-50 p-4 rounded text-gray-700">
                            {{ $feedback->comment }}
                        </div>
                    </div>
                    
                    <div>
                        <div class="text-sm font-medium text-gray-500 mb-1">Date du feedback :</div>
                        <div class="text-lg text-gray-900">{{ $feedback->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Reservation Info -->
            <div class="bg-white rounded-lg shadow overflow-hidden mt-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium">Détails de la réservation</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <div class="text-sm font-medium text-gray-500 mb-1">Date :</div>
                            <div class="text-gray-900">{{ \Carbon\Carbon::parse($feedback->reservation->date)->format('d/m/Y') }}</div>
                        </div>
                        
                        <div>
                            <div class="text-sm font-medium text-gray-500 mb-1">Heure :</div>
                            <div class="text-gray-900">{{ \Carbon\Carbon::parse($feedback->reservation->time_slot)->format('H:i') }}</div>
                        </div>
                        
                        <div>
                            <div class="text-sm font-medium text-gray-500 mb-1">Statut :</div>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Terminée
                            </span>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('admin.interviews.show', $feedback->reservation->id) }}" class="text-blue-600 hover:text-blue-900">
                            Voir tous les détails de la réservation →
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- User & Consultant Info -->
        <div class="lg:col-span-1 space-y-6">
            <!-- User Info -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium">Client</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $feedback->user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $feedback->user->email }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="mailto:{{ $feedback->user->email }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            Email
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Consultant Info -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium">Consultant</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $feedback->consultant->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $feedback->consultant->email }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="mailto:{{ $feedback->consultant->email }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                            </svg>
                            Email
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection