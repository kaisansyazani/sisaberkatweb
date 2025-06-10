<form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('PATCH')

    <!-- Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="name" id="name"
               class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
               value="{{ old('name', Auth::user()->name) }}" required />
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Phone Number -->
    <div>
        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
        <input type="tel" name="phone" id="phone"
               class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
               value="{{ old('phone', Auth::user()->phone) }}" />
        @error('phone')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Address -->
    <div>
        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
        <input type="text" name="address" id="address"
               class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
               value="{{ old('address', Auth::user()->address) }}" />
        @error('address')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password -->
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password (optional)</label>
        <input type="password" name="password" id="password"
               class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
               autocomplete="new-password" />
        @error('password')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation"
               class="w-full px-4 py-2 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
               autocomplete="new-password" />
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end space-x-3 mt-6">
        <button type="button" id="closeEditModalBtn"
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
            Cancel
        </button>
        <button type="submit"
                class="px-4 py-2 bg-[#bfcfab] hover:bg-[#7f9d6f] text-white rounded-md transition shadow-sm hover:shadow">
            Save Changes
        </button>
    </div>
</form>