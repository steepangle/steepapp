<?php

namespace App\Http\Controllers;

use App\Models\ArchiveItem;
use Illuminate\Http\Response;

class ArchiveController extends Controller
{
    public function show(ArchiveItem $archive)
    {
        $this->authorize('view', $archive);

        return response()->file(storage_path('app/' . $archive->file_path));
    }
}
