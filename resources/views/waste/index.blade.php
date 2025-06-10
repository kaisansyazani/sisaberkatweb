@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md w-full max-w-full">
    <!-- Main Content -->
    <main class="space-y-8 p-6 md:p-10">

        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold text-green-700">Your Waste Records</h1>

            <!-- Trigger Modal Button -->
            <button id="openModalBtn" class="inline-flex items-center px-4 py-2 bg-[#bfcfab] hover:bg-[#7f9d6f] text-white rounded-md transition duration-300 shadow-sm hover:shadow">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H9a1 1 0 110-2h3V6a1 1 0 011-1z" />
                </svg>
                Add New Waste
            </button>
        </div>

        <!-- Waste Table Section -->
        <section class="bg-[#E8F5E9] rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold mb-4 text-green-600">Available Waste Records</h2>

            @if ($wastes->isEmpty())
                <p class="text-gray-500 italic">No waste records found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-white border-b border-green-200">
                            <tr>
                                <th class="px-4 py-3 text-green-800 font-medium">Type</th>
                                <th class="px-4 py-3 text-green-800 font-medium">Weight (kg)</th>
                                <th class="px-4 py-3 text-green-800 font-medium">Total Price</th>
                                <th class="px-4 py-3 text-green-800 font-medium">Description</th>
                                <th class="px-4 py-3 text-green-800 font-medium">Image</th>
                                <th class="px-4 py-3 text-green-800 font-medium">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-green-200">
                            @foreach ($wastes as $waste)
                                <tr class="hover:bg-green-50 transition">
                                    <td class="px-4 py-3">{{ $waste->wasteType->name }}</td>
                                    <td class="px-4 py-3">{{ $waste->weight }}</td>
                                    <td class="px-4 py-3">RM {{ number_format($waste->price, 2) }}</td>
                                    <td class="px-4 py-3">{{ $waste->description ?: '-' }}</td>
                                   <td class="px-4 py-3">
@if ($waste->image)
<img src="{{ route('waste.image', $waste->id) }}" 
     alt="Waste Image" 
     onerror="this.src='{{ asset('/storage/waste_images/placeholder.png') }}'" 
     class="max-h-20 rounded-md border border-gray-200 shadow-sm">
@else
    <span class="text-gray-400 text-sm">No image</span>
@endif
</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-block px-3 py-1 text-xs font-semibold text-white rounded-full
                                            @if($waste->status === 'posted') bg-blue-500
                                            @elseif($waste->status === 'booked') bg-yellow-500
                                            @else bg-green-500
                                            @endif">
                                            {{ ucfirst($waste->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

    </main>
</div>

<!-- Modal -->
<div id="addWasteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black opacity-50"></div>

    <!-- Modal Content -->
    <div class="relative bg-white rounded-lg shadow-lg w-full max-w-md mx-auto p-6 z-10">
        <button id="closeModalBtn" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-xl">&times;</button>
        
        <!-- Load the create form here -->
        @include('waste.create-form') <!-- Reusable form partial -->

    </div>
</div>

<!-- Script to Toggle Modal -->
<script>
    const openModalBtn = document.getElementById('openModalBtn');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modal = document.getElementById('addWasteModal');

    openModalBtn.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    closeModalBtn.addEventListener('click', () => {
        modal.classList.add('hidden');
    });

    // Optional: Close modal when clicking outside
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>
@endsection