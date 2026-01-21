<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Archives') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($archives->isEmpty())
                <p class="text-gray-600">No archives available.</p>
            @else
                <ul class="space-y-2">
                    @foreach($archives as $archive)
                        <li class="p-4 border rounded hover:bg-gray-50">
                            <a href="{{ route('archive.show', $archive) }}" class="text-blue-600 hover:underline">
                                {{ $archive->title }}
                            </a>
                            @if($archive->access_level === 'private')
                                <span class="text-red-500 font-semibold">(Private)</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
