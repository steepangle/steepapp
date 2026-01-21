<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Archives</h1>

    @if($archives->isEmpty())
        <p>No archives available.</p>
    @else
        <ul class="space-y-2">
            @foreach($archives as $archive)
                <li class="p-2 border rounded">
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
</x-app-layout>
