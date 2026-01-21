<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Archives
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            @forelse ($archiveItems as $item)
                <div class="p-4 bg-white shadow rounded-lg flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">{{ $item->title }}</h3>
                        @if ($item->description)
                            <p class="text-sm text-gray-500 mt-1">{{ $item->description }}</p>
                        @endif
                        @if (isset($accessMap[$item->access_level]))
                            <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold rounded" 
                                  style="background-color: {{ $accessMap[$item->access_level]['color'] }};">
                                {{ $accessMap[$item->access_level]['symbol'] }} 
                                {{ $accessMap[$item->access_level]['name'] }}
                            </span>
                        @endif
                    </div>
                    @if ($item->file_path)
                        <a href="{{ asset('storage/' . $item->file_path) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium">
                            View PDF
                        </a>
                    @endif
                </div>
            @empty
                <p class="text-gray-500">No archives available.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
