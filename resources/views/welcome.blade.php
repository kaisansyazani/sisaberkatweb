<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome - SisaBerkat</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-textPrimary font-sans antialiased min-h-screen flex items-center justify-center px-4">
  <div class="max-w-2xl w-full text-center">
    <!-- Logo -->
    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-[#22c55e]" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-label="SisaBerkat Logo">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19.428 15.428a2 2 0 00-1.022-.547l-2.357-.47 1.022-2.226a2 2 0 00-.14-1.856l-1.21-1.21a2 2 0 00-1.856-.14L11.072 8.356a2 2 0 00-2.226 1.022L8.376 11.735a2 2 0 00-.547 1.022l-2.357 4.94A2 2 0 005.47 19.428l4.94-2.357a2 2 0 001.022-.547l2.357-.47a2 2 0 001.856.14l1.21 1.21a2 2 0 001.856.14l4.94-1.21a2 2 0 001.022-3.284l-2.357-2.357a2 2 0 00-.547-1.022L19.428 15.428z" />
    </svg>

    <h1 class="text-4xl font-bold mb-4">Welcome to SisaBerkat</h1>
    <p class="mb-6 text-lg text-gray-300">
      Manage your waste records, track recycling value, and earn rewards.
    </p>

    <!-- Auth Buttons -->
    <div class="flex justify-center gap-4 flex-wrap">
        @if (Route::has('login'))
            @guest
                <a href="{{ route('login') }}"
                   class="px-6 py-3 rounded-md bg-[#bfcfab] hover:bg-[#7f9d6f] text-white font-medium transition duration-300 shadow-md hover:shadow-lg">
                    Log in
                </a>
                <a href="{{ route('register') }}"
                   class="px-6 py-3 rounded-md bg-[#bfcfab] hover:bg-[#7f9d6f] text-white font-medium transition duration-300 shadow-md hover:shadow-lg">
                    Register
                </a>
            @else
                <p class="text-gray-300">You are logged in.</p>
            @endguest
        @endif
    </div>

    <!-- Features Section -->
    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
      <div class="bg-gray-800 p-5 rounded-xl shadow hover:shadow-lg transition">
        <h3 class="font-semibold text-lg mb-2 text-[#22c55e]">Add Waste</h3>
        <p class="text-sm text-gray-400">Easily record your recyclable waste and calculate earnings.</p>
      </div>
      <div class="bg-gray-800 p-5 rounded-xl shadow hover:shadow-lg transition">
        <h3 class="font-semibold text-lg mb-2 text-[#22c55e]">Track Earnings</h3>
        <p class="text-sm text-gray-400">See how much you've earned through recycling.</p>
      </div>
      <div class="bg-gray-800 p-5 rounded-xl shadow hover:shadow-lg transition">
        <h3 class="font-semibold text-lg mb-2 text-[#22c55e]">Notifications</h3>
        <p class="text-sm text-gray-400">Get updates when your waste is collected or paid out.</p>
      </div>
    </div>
  </div>
</body>
</html>