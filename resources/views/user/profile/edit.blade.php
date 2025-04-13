@extends('layouts.app')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <h1 class="text-2xl font-bold mb-6">Edit Your Profile</h1>
    
    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Personal Information -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Personal Information</h2>
                
                <!-- Replace the single name field with separate first_name and last_name fields -->
                <div class="mb-4">
                    <label for="first_name" class="block text-gray-700 text-sm font-medium mb-2">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ auth()->user()->first_name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('first_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="last_name" class="block text-gray-700 text-sm font-medium mb-2">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ auth()->user()->last_name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('last_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="username" class="block text-gray-700 text-sm font-medium mb-2">Username</label>
                    <input type="text" name="username" id="username" value="{{ auth()->user()->username }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('username')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 text-sm font-medium mb-2">Phone Number</label>
                    <input type="text" name="phone" id="phone" value="{{ auth()->user()->phone ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="whatsapp" class="block text-gray-700 text-sm font-medium mb-2">WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp" value="{{ auth()->user()->whatsapp ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('whatsapp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Account Settings -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Account Settings</h2>
                
                <div class="mb-4">
                    <label for="current_password" class="block text-gray-700 text-sm font-medium mb-2">Current Password</label>
                    <input type="password" name="current_password" id="current_password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('current_password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-2">New Password</label>
                    <input type="password" name="password" id="password" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-medium mb-2">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>
        </div>
        
        <!-- Profile Picture -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Profile Picture</h2>
            
            <div class="flex items-center space-x-6">
                <div class="shrink-0">
                    <div id="current_profile_image">
                        @if(auth()->user()->profile_picture)
                            <img class="h-16 w-16 object-cover rounded-full" src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Current profile photo">
                        @else
                            <img class="h-16 w-16 object-cover rounded-full" src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" alt="Current profile photo">
                        @endif
                    </div>
                    <div id="image_preview" class="hidden">
                        <img id="preview_img" src="#" alt="Profile preview" class="h-16 w-16 object-cover rounded-full">
                    </div>
                </div>
                <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file" 
                           id="profile_picture" 
                           name="profile_picture" 
                           accept="image/*"
                           class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-indigo-50 file:text-indigo-700
                                  hover:file:bg-indigo-100">
                    <p class="mt-1 text-sm text-gray-500">
                        JPG, PNG, GIF up to 2MB
                    </p>
                </label>
            </div>
            @error('profile_picture')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Additional Information -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Additional Information</h2>
            
            <div class="mb-4">
                <label for="bio" class="block text-gray-700 text-sm font-medium mb-2">Bio</label>
                <textarea name="bio" id="bio" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ auth()->user()->bio ?? '' }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="location" class="block text-gray-700 text-sm font-medium mb-2">Location</label>
                    <input type="text" name="location" id="location" value="{{ auth()->user()->location ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('location')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="website" class="block text-gray-700 text-sm font-medium mb-2">Website</label>
                    <input type="url" name="website" id="website" value="{{ auth()->user()->website ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('website')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="address" class="block text-gray-700 text-sm font-medium mb-2">Address</label>
                <input type="text" name="address" id="address" value="{{ auth()->user()->address ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-medium mb-2">Professional Title</label>
                <input type="text" name="title" id="title" value="{{ auth()->user()->title ?? '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                Save Changes
            </button>
        </div>
    </form>
</div>

<script>
    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        const inputElement = document.getElementById('profile_picture');
        const previewDiv = document.getElementById('image_preview');
        const previewImg = document.getElementById('preview_img');
        const currentImageDiv = document.getElementById('current_profile_image');
        
        if (inputElement) {
            inputElement.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // Set the image source
                        previewImg.src = e.target.result;
                        
                        // Show the preview div
                        previewDiv.classList.remove('hidden');
                        
                        // Hide the current image div
                        currentImageDiv.classList.add('hidden');
                    };
                    
                    reader.readAsDataURL(this.files[0]);
                }
            });
        }
    });
</script>
@endsection