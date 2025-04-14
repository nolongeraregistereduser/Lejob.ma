<!-- filepath: resources/views/consultant/bookings.blade.php -->
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Manage Booking Requests</h2>

                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                <div class="mb-6">
                    <ul class="flex border-b">
                        <li class="-mb-px mr-1">
                            <a href="#pending" class="bg-white inline-block py-2 px-4 text-blue-600 font-semibold border-l border-t border-r rounded-t tab-active" onclick="switchTab(event, 'pending')">
                                Pending
                                <span class="ml-2 px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">{{ $pendingCount ?? 0 }}</span>
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#confirmed" class="bg-white inline-block py-2 px-4 text-gray-600 font-semibold rounded-t hover:text-blue-600" onclick="switchTab(event, 'confirmed')">
                                Confirmed
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#completed" class="bg-white inline-block py-2 px-4 text-gray-600 font-semibold rounded-t hover:text-blue-600" onclick="switchTab(event, 'completed')">
                                Completed
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#cancelled" class="bg-white inline-block py-2 px-4 text-gray-600 font-semibold rounded-t hover:text-blue-600" onclick="switchTab(event, 'cancelled')">
                                Cancelled
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Pending tab -->
                <div id="pending" class="tab-content">
                    @if($pendingReservations && $pendingReservations->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500">No pending reservation requests.</p>
                    </div>
                    @else
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Date & Time
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($pendingReservations ?? [] as $reservation)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($reservation->user->name) }}&color=7F9CF5&background=EBF4FF" alt="User">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{ $reservation->user->name }}
                                            </div>
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ $reservation->user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ \Carbon\Carbon::parse($reservation->date)->format('l, M d, Y') }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ \Carbon\Carbon::parse($reservation->time_slot)->format('h:i A') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('consultant.bookings.accept', $reservation->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                                Accept
                                            </button>
                                        </form>
                                        <form action="{{ route('consultant.bookings.reject', $reservation->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

                <!-- Other tabs similar structure (confirmed, completed, cancelled) -->
                <div id="confirmed" class="tab-content hidden">
                    <!-- Confirmed reservations table -->
                </div>

                <div id="completed" class="tab-content hidden">
                    <!-- Completed reservations table -->
                </div>

                <div id="cancelled" class="tab-content hidden">
                    <!-- Cancelled reservations table -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(event, tabId) {
        event.preventDefault();
        
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Remove active class from all tab links
        document.querySelectorAll('ul.flex a').forEach(link => {
            link.classList.remove('tab-active', 'border-l', 'border-t', 'border-r', 'text-blue-600');
            link.classList.add('text-gray-600');
        });
        
        // Show the selected tab
        document.getElementById(tabId).classList.remove('hidden');
        
        // Add active class to the clicked tab link
        event.target.classList.add('tab-active', 'border-l', 'border-t', 'border-r', 'text-blue-600');
        event.target.classList.remove('text-gray-600');
    }
</script>
@endsection