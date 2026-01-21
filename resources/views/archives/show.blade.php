<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-4">{{ $archive->title }}</h1>
            <p class="text-gray-700 mb-6">{{ $archive->description }}</p>

            @if($archive->file_path)
                <div class="mb-6">
                    <a href="{{ asset('storage/' . $archive->file_path) }}" target="_blank" class="text-blue-600 hover:underline">
                        View / Download File
                    </a>
                </div>
            @endif

            <a href="{{ route('archive.index') }}" class="text-gray-600 hover:text-gray-800">&larr; Back to Archives</a>
        </div>
    </div>
</x-app-layout>
