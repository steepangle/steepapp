<h1>Archives</h1>

<ul>
@foreach ($archives as $archive)
    <li>
        <a href="{{ route('archive.show', $archive->id) }}">
            {{ $archive->title }}
        </a>
    </li>
@endforeach
</ul>
