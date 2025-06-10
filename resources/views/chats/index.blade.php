@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md w-full max-w-4xl mx-auto">
    <main class="p-6 space-y-6">

        <!-- Page Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold text-green-700">Chats</h1>
        </div>

        <!-- Chats List Section -->
        <section class="bg-[#E8F5E9] rounded-xl p-6 shadow-sm">
            <h2 class="text-lg font-semibold mb-4 text-green-600">Recent Conversations</h2>

            @if(count($chats) > 0)
                <div class="space-y-4">
                    @foreach ($chats as $chat)
                        <a href="{{ route('chats.show', $chat['id']) }}" class="block">
                            <div class="flex items-center gap-4 p-4 bg-white rounded-lg shadow-sm hover:bg-green-50 transition">
                                <!-- Avatar Placeholder -->
                                <div class="w-12 h-12 rounded-full bg-green-200 flex items-center justify-center text-green-700 font-bold">
                                    {{ strtoupper(substr($chat['with'], 0, 1)) }}
                                </div>
                                <!-- Chat Info -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-medium text-green-800 truncate">{{ $chat['with'] }}</h3>
                                    <p class="text-gray-600 text-sm truncate">{{ $chat['last_message'] }}</p>
                                </div>
                                <!-- Timestamp -->
                                <div class="text-xs text-gray-400 whitespace-nowrap">
                                    {{ $chat['time'] }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">No chats found.</p>
            @endif
        </section>

    </main>
</div>
@endsection