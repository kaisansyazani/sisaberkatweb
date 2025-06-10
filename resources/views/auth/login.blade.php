<x-guest-layout>
    <body class="bg-background text-textPrimary font-sans antialiased min-h-screen flex items-center justify-center px-4">
   
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-[#5f7f4f]" />
            <x-text-input id="email" class="block mt-1 w-full bg-[#292524] border-gray-600 text-white placeholder-gray-400" 
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-[#5f7f4f]" />
            <x-text-input id="password" class="block mt-1 w-full bg-[#292524] border-gray-600 text-white placeholder-gray-400"
                type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-600 bg-[#bfcfab] text-[#4ade80] shadow-sm focus:ring-[#22c55e] focus:ring-2"
                    name="remember">
                <span class="ml-2 text-sm text-[#5f7f4f]">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-[#bfcfab] hover:text-[#eab308] transition" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3 bg-[#bfcfab] hover:bg-[#7f9d6f] text-[#ffffff] px-4 py-2 rounded-md transition">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="mt-6 text-center">
            <span class="text-sm text-gray-400">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-[#bfcfab] hover:text-[#7f9d6f] underline ml-1">
                {{ __('Register') }}
            </a>
    </form>
</x-guest-layout>
