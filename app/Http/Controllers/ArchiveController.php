<?php

namespace App\Http\Controllers;

use App\Models\ArchiveItem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    public function show(ArchiveItem $archive)
    {
        $this->authorize('view', $archive);

        return response()->file(storage_path('app/' . $archive->file_path));
    }
}

public function index()
{
    $user = Auth::user(); // get currently logged-in user

    // Start query: public archives visible to everyone
    $query = ArchiveItem::where('access_level', 'public');

    // If a user is logged in, also include private archives for their groups
    if ($user) {
        $query->orWhereHas('userGroups', function($q) use ($user) {
            $q->whereIn('user_groups.id', $user->userGroups->pluck('id'));
        });
    }

    $archives = $query->get(); // execute query

    return view('archives.index', compact('archives')); // send to view
}
