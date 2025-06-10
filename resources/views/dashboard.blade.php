@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md w-full max-w-full">

    <!-- Main Content -->
    <main class="space-y-8 p-6 md:p-10">
        <!-- Donation Categories -->
        <section class="bg-[#E8F5E9] rounded-xl p-6 mb-8 shadow-sm">
            <h2 class="text-lg font-semibold mb-4 text-green-600">Categories</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6" id="categoryFilters">
                @php
                    $categories = ['Vegetables', 'Fruits', 'Rice', 'Leftover Food', 'Miscellaneous'];
                @endphp
                @foreach($categories as $category)
                    <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition cursor-pointer filter-category"
                         data-type="{{ $category }}" onclick="filterWaste(this)">
                        <div class="text-3xl">
                            @switch($category)
                                @case('Vegetables') 🥦 @break
                                @case('Fruits') 🍎 @break
                                @case('Rice') 🍚 @break
                                @case('Leftover Food') 🍲 @break
                                @default 🧺 @endswitch
                        </div>
                        <p class="text-sm mt-2 text-gray-700">{{ $category }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Available Waste Records -->
        <section class="bg-[#E8F5E9] rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold mb-4 text-green-600">Waste For Sale</h2>

            @if ($wastes->isEmpty())
                <p class="text-gray-500 italic">No waste records found.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4" id="wasteCards">
                    @foreach ($wastes as $waste)
                        <div class="bg-white rounded-lg shadow-md p-4 flex flex-col items-center space-y-2 waste-card cursor-pointer"
                             data-type="{{ $waste->wasteType->name }}"
                             onclick='showWasteDetails({!! htmlspecialchars(json_encode([
                                 "id" => $waste->id,
                                 "waste_type" => ["name" => $waste->wasteType->name],
                                 "weight" => $waste->weight,
                                 "total_price" => $waste->price,
                                 "description" => $waste->description ?? "",
                                 "image" => $waste->image ? "waste_".$waste->id.".jpg" : null,
     "user" => [
        "name" => optional($waste->user)->name ?? "Unknown",
        "phone" => optional($waste->user)->phone ?? "Not provided",
        "address" => optional($waste->user)->address ?? "Not provided"
    ]
                             ]), ENT_QUOTES, "UTF-8") !!})'>
                            <img src="{{ route('waste.image', $waste->id) }}" 
                                 alt="Waste Image" 
                                 onerror="this.src='{{ asset('/storage/waste_images/placeholder.png') }}'" 
                                 class="max-h-40 rounded-md border border-gray-200 shadow-sm">
                            <div class="text-green-600 font-bold">{{ 'RM ' . number_format($waste->price, 2) }}</div>
                            <div class="text-gray-700">{{ $waste->wasteType->name }}</div>
                            <div class="text-gray-500">{{ $waste->weight }} kg</div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </main>
</div>

<!-- Modal -->
<div id="wasteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50 px-4">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6 relative">
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
        <h3 class="text-xl font-bold text-green-600 mb-4">Product Details</h3>
        <img id="modalImage" class="w-full h-auto rounded-md mb-4" src="" alt="Product Image"
             onerror="this.src='{{ asset('storage/waste_images/placeholder.png') }}';">
        <p><strong>Category:</strong> <span id="modalCategory"></span></p>
        <p><strong>Weight:</strong> <span id="modalWeight"></span> kg</p>
        <p><strong>Price:</strong> RM <span id="modalPrice"></span></p>
        <p><strong>Description:</strong> <span id="modalDescription"></span></p>
        <p><strong>Seller:</strong> <span id="modalSellerName"></span></p>
        <p><strong>Phone:</strong> <span id="modalSellerPhone"></span></p>
        <p><strong>Address:</strong> <span id="modalSellerAddress"></span></p>
    </div>
</div>

<!-- SCRIPTS GO HERE AT THE BOTTOM -->
<script>
    // Ensure functions are globally available
    window.showWasteDetails = function(waste) {
        console.log("Opening modal for:", waste);
       const imagePath = waste.image
        ? "/waste/image/" + waste.id  // 👈 Use same route as card
        : "{{ asset('storage/waste_images/placeholder.png') }}";


        document.getElementById('modalImage').src = imagePath;
        document.getElementById('modalCategory').textContent = waste.waste_type?.name || 'Unknown';
        document.getElementById('modalWeight').textContent = waste.weight || 'N/A';
        document.getElementById('modalPrice').textContent = parseFloat(waste.total_price).toFixed(2);
        document.getElementById('modalDescription').textContent = waste.description || 'No description available.';

        document.getElementById('modalSellerName').textContent = waste.user?.name || 'Unknown';
        document.getElementById('modalSellerPhone').textContent = waste.user?.phone || 'Not provided';
        document.getElementById('modalSellerAddress').textContent = waste.user?.address || 'Not provided';

        document.getElementById('wasteModal').classList.remove('hidden');
    };

    window.closeModal = function() {
        document.getElementById('wasteModal').classList.add('hidden');
    };

    window.filterWaste = function(element) {
        const selectedType = element.getAttribute('data-type');

        document.querySelectorAll('.filter-category').forEach(cat => {
            cat.classList.remove('ring-2', 'ring-green-500');
        });

        element.classList.add('ring-2', 'ring-green-500');

        const cards = document.querySelectorAll('.waste-card');

        cards.forEach(card => {
            const cardType = card.getAttribute('data-type');
            if (selectedType === 'All' || cardType === selectedType) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    };

    // Add "All" button dynamically
    document.addEventListener("DOMContentLoaded", function () {
        const allButton = document.createElement('div');
        allButton.className = 'flex flex-col items-center p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition cursor-pointer filter-category ring-2 ring-green-500';
        allButton.setAttribute('data-type', 'All');
        allButton.innerHTML = `
            <div class="text-3xl">🌐</div>
            <p class="text-sm mt-2 text-gray-700">All</p>
        `;
        allButton.onclick = () => {
            document.querySelectorAll('.waste-card').forEach(card => {
                card.style.display = '';
            });
            document.querySelectorAll('.filter-category').forEach(cat => {
                cat.classList.remove('ring-2', 'ring-green-500');
            });
            allButton.classList.add('ring-2', 'ring-green-500');
        };

        const categoryFilters = document.getElementById('categoryFilters');
        if (categoryFilters) {
            categoryFilters.prepend(allButton);
        }
    });
</script>
@endsection