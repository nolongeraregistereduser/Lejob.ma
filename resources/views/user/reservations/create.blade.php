<!-- filepath: resources/views/user/reservations/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Book a Consultation Session</h2>
                    <a href="{{ route('user.reservations.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md transition">
                        <i class="fas fa-arrow-left mr-2"></i>Back to My Reservations
                    </a>
                </div>

                @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
                @endif

                <form action="{{ route('user.reservations.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="consultant_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Select a Consultant <span class="text-red-500">*</span>
                        </label>
                        <select id="consultant_id" name="consultant_id" required 
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('consultant_id') border-red-500 @enderror">
                            <option value="">-- Choose a consultant --</option>
                            @foreach($consultants as $consultant)
                                <option value="{{ $consultant->id }}" {{ old('consultant_id') == $consultant->id ? 'selected' : '' }}>
                                    {{ $consultant->name }} - {{ $consultant->speciality ?? 'General Consultant' }}
                                </option>
                            @endforeach
                        </select>
                        @error('consultant_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700 mb-2">
                                Date <span class="text-red-500">*</span>
                            </label>
                            <input type="date" id="date" name="date" 
                                min="{{ date('Y-m-d') }}"
                                value="{{ old('date') }}"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('date') border-red-500 @enderror"
                                required>
                            @error('date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="time_slot" class="block text-sm font-medium text-gray-700 mb-2">
                                Time Slot <span class="text-red-500">*</span>
                            </label>
                            <select id="time_slot" name="time_slot" required
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('time_slot') border-red-500 @enderror">
                                <option value="">-- Select a time --</option>
                                <option value="09:00" {{ old('time_slot') == '09:00' ? 'selected' : '' }}>9:00 AM</option>
                                <option value="10:00" {{ old('time_slot') == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                                <option value="11:00" {{ old('time_slot') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                <option value="13:00" {{ old('time_slot') == '13:00' ? 'selected' : '' }}>1:00 PM</option>
                                <option value="14:00" {{ old('time_slot') == '14:00' ? 'selected' : '' }}>2:00 PM</option>
                                <option value="15:00" {{ old('time_slot') == '15:00' ? 'selected' : '' }}>3:00 PM</option>
                                <option value="16:00" {{ old('time_slot') == '16:00' ? 'selected' : '' }}>4:00 PM</option>
                            </select>
                            @error('time_slot')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <button type="submit" class="w-full md:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md shadow-sm transition duration-150 ease-in-out">
                            Book Appointment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection