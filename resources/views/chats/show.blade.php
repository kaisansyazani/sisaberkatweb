@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md w-full max-w-4xl mx-auto">
    <main class="p-6 space-y-6">

        <!-- Chat Header -->
       <!-- Chat Header -->
<div class="flex items-center space-x-4">
    <!-- Back Button -->
    <a href="{{ route('chats.index') }}" 
       class="inline-flex items-center px-3 py-2 text-sm bg-green-500 hover:bg-gray-300 text-gray-700 rounded-md transition duration-200">
        ← Back
    </a>

    <!-- Chat Title -->
    <h1 class="text-xl font-bold text-green-700">Chat with {{ $chatUser }}</h1>
</div>

        <!-- Messages Section -->
        <section class="bg-[#E8F5E9] rounded-xl p-6 shadow-sm h-[60vh] overflow-y-auto flex flex-col space-y-4">
            @if(count($messages) > 0)
                @foreach ($messages as $message)
                    <div class="flex {{ $message['sender'] === 'You' ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs md:max-w-md px-4 py-2 rounded-lg bg-{{ $message['sender'] === 'You' ? 'green-500 text-white' : 'white' }} border border-green-200 shadow-sm">
                            <div class="font-medium text-sm text-green-800">{{ $message['sender'] }}</div>
                            <p class="mt-1 text-sm">{{ $message['content'] }}</p>
                            <div class="text-xs text-gray-400 mt-1">{{ $message['time'] }}</div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500 italic">No messages yet.</p>
            @endif
        </section>

<!-- Message Input Form -->
<form action="{{ route('message.store', $id) }}" method="POST" class="flex gap-2">
    @csrf
    <input type="text" name="content" placeholder="Type your message..." 
           class="flex-1 px-4 py-2 border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400" />
    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
        Send
    </button>
</form>
        </form>

    </main>
</div>
@endsection