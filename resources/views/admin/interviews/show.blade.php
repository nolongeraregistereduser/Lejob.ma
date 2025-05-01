<!-- filepath: c:\Users\LENOVO\Desktop\Desktop FIL ROUGE\Lejob.ma\resources\views\admin\interviews\show.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <a href="{{ route('admin.interviews.index') }}" class="text-blue-600 hover:text-blue-900 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
                Retour aux réservations
            </a>
            <h1 class="text-2xl font-bold mt-2">Détails de la réservation #{{ $reservation->id }}</h1>
        </div>
        
        <div class="flex space-x-2">
            <form action="{{ route('admin.interviews.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                    Supprimer
                </button>
            </form>
        </div>
    </div>
    
    @if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
        <p>{{ session('success') }}</p>
    </div>
    @endif
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Reservation Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium">Information de réservation</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <div class="text-sm font-medium text-gray-500 mb-1">Date</div>
                            <div class="text-lg text-gray-900">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</div>
                        </div>
                        
                        <div>
                            <div class="text-sm font-medium text-gray-500 mb-1">Heure</div>
                            <div class="text-lg text-gray-900">{{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }}</div>
                        </div>
                        
                        <div>
                            <div class="text-sm font-medium text-gray-500 mb-1">Statut</div>
                            <div>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($reservation->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                                    @if($reservation->status == 'confirmed') bg-blue-100 text-blue-800 @endif
                                    @if($reservation->status == 'completed') bg-green-100 text-green-800 @endif
                                    @if($reservation->status == 'cancelled') bg-red-100 text-red-800 @endif
                                ">
                                    @if($reservation->status == 'pending') En attente @endif
                                    @if($reservation->status == 'confirmed') Confirmée @endif
                                    @if($reservation->status == 'completed') Terminée @endif
                                    @if($reservation->status == 'cancelled') Annulée @endif
                                </span>
                            </div>
                        </div>
                        
                        <div>
                            <div class="text-sm font-medium text-gray-500 mb-1">Créée le</div>
                            <div class="text-lg text-gray-900">{{ $reservation->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                    
                    @if($reservation->notes)
                    <div class="mt-6">
                        <div class="text-sm font-medium text-gray-500 mb-1">Notes</div>
                        <div class="bg-gray-50 p-4 rounded text-gray-700">
                            {{ $reservation->notes }}
                        </div>
                    </div>
                    @endif
                    
                    <!-- Update Status Form -->
                    <form action="{{ route('admin.interviews.update-status', $reservation->id) }}" method="POST" class="mt-6">
                        @csrf
                        @method('PATCH')
                        
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Mettre à jour le statut</label>
                            <select id="status" name="status" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                                <option value="completed" {{ $reservation->status == 'completed' ? 'selected' : '' }}>Terminée</option>
                                <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </div>
                        
                        <div class="mt-4">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes additionnelles</label>
                            <textarea id="notes" name="notes" rows="3" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                        </div>
                        
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Feedback Section if exists -->
            @if($reservation->feedback)
            <div class="bg-white rounded-lg shadow overflow-hidden mt-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-medium">Avis du client</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="text-sm font-medium text-gray-500 mr-2">Note:</div>
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $reservation->feedback->rating)
                                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @else
                                    <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endif
                            @endfor
                        </div>
                        <div class="text-sm text-gray-500 ml-2">({{ $reservation->feedback->rating }}/5)</div>
                    </div>
                    
                    <div class="mt-2">
                        <div class="text-sm font-medium text-gray-500 mb-1">Commentaire:</div>
                        <div class="bg-gray-50 p-4 rounded text-gray-700">
                            {{ $reservation->feedback->comment }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
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
                            <h3 class="text-lg font-medium text-gray-900">{{ $reservation->user->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $reservation->user->email }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex space-x-2">
                        <a href="mailto:{{ $reservation->user->email }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
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
                            <h3 class="text-lg font-medium text-gray-900">{{ $reservation->consultant->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $reservation->consultant->email }}</p>
                        </div>
                    </div>
                    
                    <div class="mt-4 flex space-x-2">
                        <a href="mailto:{{ $reservation->consultant->email }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 shadow-sm text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
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