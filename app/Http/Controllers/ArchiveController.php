<?php

namespace App\Http\Controllers;

use App\Models\ArchiveItem;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // currently logged-in user
        $userGroupIds = $user ? $user->userGroups->pluck('id')->toArray() : [];

        // Fetch archives:
        // - public archives
        // - or archives where user's groups have access
        $archives = ArchiveItem::where('access_level', 'public')
            ->orWhereExists(function ($query) use ($userGroupIds) {
                $query->selectRaw('1')
                      ->from('archive_item_user_groups')
                      ->whereColumn('archive_item_user_groups.archive_item_id', 'archive_items.id')
                      ->whereIn('archive_item_user_groups.user_group_id', $userGroupIds);
            })
            ->get();

        return view('archives.index', compact('archives'));
    }
}

