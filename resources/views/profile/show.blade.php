@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md w-full max-w-full">
    <!-- Main Content -->
    <main class="space-y-8 p-6 md:p-10">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold text-green-700">Your Profile</h1>

            <!-- Edit Button -->
<button id="openEditModal" class="inline-flex items-center px-4 py-2 bg-[#bfcfab] hover:bg-[#7f9d6f] text-white rounded-md transition duration-300 shadow-sm hover:shadow">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
    </svg>
    Edit Profile
</button>
        </div>

        <!-- Profile Info Section -->
        <section class="bg-[#E8F5E9] rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold mb-4 text-green-600">Profile Details</h2>

            <div class="overflow-hidden">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-4 gap-y-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-700">Name</dt>
                        <dd class="mt-1 text-gray-900">{{ Auth::user()->name }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-700">Email</dt>
                        <dd class="mt-1 text-gray-900">{{ Auth::user()->email }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-700">Phone Number</dt>
                        <dd class="mt-1 text-gray-900">{{ Auth::user()->phone ?? 'Not provided' }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-700">Address</dt>
                        <dd class="mt-1 text-gray-900">{{ Auth::user()->address ?? 'Not provided' }}</dd>
                    </div>
                </dl>
            </div>
        </section>
<!-- Modal -->
<div id="editProfileModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black opacity-50"></div>

    <!-- Modal Content -->
    <div class="relative bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6 z-10">
        <button id="closeEditModalBtn" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
        
        <!-- Load the edit form here -->
        @include('profile.edit-form') <!-- Make sure this partial exists -->

    </div>
</div>

<!-- Script to Toggle Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButton = document.getElementById('openEditModal');
        const modal = document.getElementById('editProfileModal');
        const closeModalBtn = document.getElementById('closeEditModalBtn');

        editButton.addEventListener('click', () => {
            modal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
    </main>
</div>
@endsection