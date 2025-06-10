@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md w-full max-w-full">
    <!-- Main Content -->
    <main class="space-y-8 p-6 md:p-10">
        <!-- Notifications Section -->
        <section class="bg-[#E8F5E9] rounded-xl p-6 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-green-600">Your Notifications</h2>

                <!-- Refresh Button -->
                <button type="button"
                    class="inline-flex items-center px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-sm font-medium rounded-md transition duration-200 shadow-sm hover:shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 00-15.357-2m15.357 2H15" />
                    </svg>
                    Refresh
                </button>
            </div>

            <!-- Notification Message -->
            <p class="text-gray-600 italic">You don't have any notifications yet.</p>
        </section>
    </main>
</div>
@endsection