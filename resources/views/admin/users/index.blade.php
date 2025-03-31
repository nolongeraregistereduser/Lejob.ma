@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Users Management</h1>
        <button class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition-colors">
            Add New User
        </button>
    </div>

    <!-- Filters -->
    <div class="flex flex-wrap gap-4 mb-6">
        <div class="flex-1 min-w-[200px]">
            <select id="role-filter" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="">All Roles</option>
                <option value="admin">Admin</option>
                <option value="consultant">Consultant</option>
                <option value="user">User</option>
            </select>
        </div>
        <div class="flex-1 min-w-[200px]">
            <select id="status-filter" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="pending">Pending</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="flex-1 min-w-[200px]">
            <input type="text" placeholder="Search users..." class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
        </div>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">User</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-center">Role</th>
                    <th class="py-3 px-6 text-center">Status</th>
                    <th class="py-3 px-6 text-center">Registered</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @forelse($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                    <span class="text-indigo-600 font-bold">{{ substr($user->name, 0, 2) }}</span>
                                </div>
                                <span class="font-medium">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <span>{{ $user->email }}</span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            @if($user->role == 'admin')
                                <span class="bg-purple-100 text-purple-600 py-1 px-3 rounded-full text-xs">Admin</span>
                            @elseif($user->role == 'consultant')
                                <span class="bg-indigo-100 text-indigo-600 py-1 px-3 rounded-full text-xs">Consultant</span>
                            @else
                                <span class="bg-blue-100 text-blue-600 py-1 px-3 rounded-full text-xs">User</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center">
                            @if($user->status == 'active')
                                <span class="bg-green-100 text-green-600 py-1 px-3 rounded-full text-xs">Active</span>
                            @elseif($user->status == 'pending')
                                <span class="bg-yellow-100 text-yellow-600 py-1 px-3 rounded-full text-xs">Pending</span>
                            @else
                                <span class="bg-red-100 text-red-600 py-1 px-3 rounded-full text-xs">Inactive</span>
                            @endif
                        </td>
                        <td class="py-3 px-6 text-center">
                            <span>{{ $user->created_at->format('d/m/Y') }}</span>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center gap-2">
                                @if($user->role == 'consultant' && $user->status == 'pending')
                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600">Approve</button>
                                    </form>
                                @endif
                                
                                @if($user->status == 'inactive')
                                    <form action="{{ route('admin.users.activate', $user->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded text-xs hover:bg-green-600">Activate</button>
                                    </form>
                                @endif
                                
                                <button class="bg-blue-500 text-white px-2 py-1 rounded text-xs hover:bg-blue-600 edit-user" data-id="{{ $user->id }}">Edit</button>
                                
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs hover:bg-red-600">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-gray-500">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    @if($users->hasPages())
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-gray-600">
            Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
        </div>
        <div class="flex space-x-2">
            {{ $users->links('pagination::tailwind') }}
        </div>
    </div>
    @endif
</div>

<!-- User Edit Modal (Hidden by default) -->
<div id="editUserModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Edit User</h2>
            <button id="closeEditModal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <form id="editUserForm" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black" id="name" name="name" type="text" placeholder="User name">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black" id="email" name="email" type="email" placeholder="Email address">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                    Role
                </label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black" id="role" name="role">
                    <option value="user">User</option>
                    <option value="consultant">Consultant</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                    Status
                </label>
                <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black" id="status" name="status">
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="cancelEditBtn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 bg-black text-white rounded-lg hover:bg-gray-800">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal (Hidden by default) -->
<div id="deleteConfirmModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Confirm Deletion</h2>
            <button id="closeDeleteModal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <p class="mb-4">Are you sure you want to delete this user? This action cannot be undone.</p>
        <div class="flex justify-end space-x-2">
            <button id="cancelDeleteBtn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                Cancel
            </button>
            <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                Delete User
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Edit modal functionality
    const editBtns = document.querySelectorAll('.edit-user');
    const editModal = document.getElementById('editUserModal');
    const closeEditModal = document.getElementById('closeEditModal');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const editUserForm = document.getElementById('editUserForm');
    
    editBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const userId = btn.getAttribute('data-id');
            // Here you would typically fetch user data and populate the form
            // For now, we'll just show the modal and set the form action
            editUserForm.action = `/admin/users/${userId}`;
            editModal.classList.remove('hidden');
        });
    });
    
    closeEditModal.addEventListener('click', () => {
        editModal.classList.add('hidden');
    });
    
    cancelEditBtn.addEventListener('click', () => {
        editModal.classList.add('hidden');
    });
    
    // Delete modal functionality
    const deleteForms = document.querySelectorAll('.delete-form');
    const deleteModal = document.getElementById('deleteConfirmModal');
    const closeDeleteModal = document.getElementById('closeDeleteModal');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    let currentDeleteForm = null;
    
    deleteForms.forEach(form => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            currentDeleteForm = form;
            deleteModal.classList.remove('hidden');
        });
    });
    
    closeDeleteModal.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });
    
    cancelDeleteBtn.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
    });
    
    confirmDeleteBtn.addEventListener('click', () => {
        if (currentDeleteForm) {
            currentDeleteForm.submit();
        }
        deleteModal.classList.add('hidden');
    });
    
    // Filter functionality
    const roleFilter = document.getElementById('role-filter');
    const statusFilter = document.getElementById('status-filter');
    const searchInput = document.querySelector('input[type="text"]');
    
    function applyFilters() {
        const role = roleFilter.value;
        const status = statusFilter.value;
        const search = searchInput.value.toLowerCase();
        
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const userRole = row.querySelector('td:nth-child(3) span').textContent.toLowerCase();
            const userStatus = row.querySelector('td:nth-child(4) span').textContent.toLowerCase();
            const userName = row.querySelector('td:nth-child(1) span').textContent.toLowerCase();
            const userEmail = row.querySelector('td:nth-child(2) span').textContent.toLowerCase();
            
            const roleMatch = !role || userRole.includes(role.toLowerCase());
            const statusMatch = !status || userStatus.includes(status.toLowerCase());
            const searchMatch = !search || userName.includes(search) || userEmail.includes(search);
            
            if (roleMatch && statusMatch && searchMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    roleFilter.addEventListener('change', applyFilters);
    statusFilter.addEventListener('change', applyFilters);
    searchInput.addEventListener('input', applyFilters);
</script>
@endpush