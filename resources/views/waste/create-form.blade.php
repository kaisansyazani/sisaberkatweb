<form action="{{ route('waste.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
    @csrf

    <!-- Waste Type -->
    <div>
        <label for="waste_type_id" class="block text-sm font-medium text-gray-700 mb-1">Waste Type</label>
        <select name="waste_type_id" id="waste_type_id" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
            @foreach ($wasteTypes as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>
        @error('waste_type_id')
            <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <!-- Weight -->
    <div>
        <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Weight (kg)</label>
        <input type="number" name="weight" id="weight" step="0.01" min="0.01"
               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
               placeholder="e.g., 2.5" required>
        @error('weight')
            <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
<div>
    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (RM) (Set the price to RM 0.00 if you wish to donate this item.)</label>
    <input type="number" name="price" id="price" step="0.01" min="0"
           class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
           placeholder="e.g., 10.00" required>
    @error('price')
        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>
<!-- Food Quality -->
<div>
    <label for="food_quality" class="block text-sm font-medium text-gray-700 mb-1">Food Quality</label>
    <select name="food_quality" id="food_quality" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" required>
        <option value="" disabled selected>-- Select the condition of the food --</option>
        <option value="fresh">Fresh – long shelf life remaining</option>
        <option value="near_expiry">Acceptable – nearing expiry date</option>
        <option value="spoiled">Poor – close to or already spoiled</option>
    </select>
    @error('food_quality')
        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
    @enderror
</div>

    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description (Optional)</label>
        <textarea name="description" id="description" rows="3"
                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                  placeholder="Any extra details..."></textarea>
        @error('description')
            <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>

<!-- Image Upload with Preview -->
<div>
    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Picture</label>
    <input type="file" name="image" id="image" accept="image/*"
           class="w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
           onchange="previewImage(event)">
    @error('image')
        <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
    @enderror

    <!-- Error Message -->
    <p id="imageError" class="mt-1 text-red-500 text-sm"></p>

    <!-- Image Preview -->
    <div class="mt-3">
        <img id="imagePreview" src="#" alt="Image Preview" class="hidden max-h-40 rounded-md border border-gray-200 shadow-sm">
    </div>
</div>

    <!-- Submit Button -->
    <div class="flex justify-end pt-2">
        <button type="submit"
                class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-md transition duration-300">
            Save Waste
        </button>
    </div>
</form>

<!-- Script for Preview -->
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const error = document.getElementById('imageError');

        if (!file) {
            preview.classList.add('hidden');
            error.textContent = '';
            return;
        }

        // File size check (now 8MB)
        const maxSizeInBytes = 8 * 1024 * 1024; // 8MB
        if (file.size > maxSizeInBytes) {
            event.target.value = ''; // Clear input
            preview.classList.add('hidden');
            error.textContent = 'File size must be less than 8MB.';
            return;
        }

        // Valid file, show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);

        error.textContent = '';
    }
</script>