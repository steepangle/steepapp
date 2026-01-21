<?php

namespace App\Http\Controllers;

use App\Models\ArchiveItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get IDs of all user groups this user belongs to
        $userGroups = $user ? $user->groups()->pluck('user_groups.id')->toArray() : [];

        // Fetch archives
        $archives = ArchiveItem::where('access_level', 'public')
            ->orWhereExists(function ($query) use ($userGroups) {
                $query->select('*')
                    ->from('user_groups')
                    ->join('archive_item_user_groups', 'user_groups.id', '=', 'archive_item_user_groups.user_group_id')
                    ->whereColumn('archive_items.id', 'archive_item_user_groups.archive_item_id')
                    ->whereIn('user_groups.id', $userGroups);
            })
            ->get();

        return view('archives.index', compact('archives'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $userGroups = $user ? $user->groups()->pluck('user_groups.id')->toArray() : [];

        $archive = ArchiveItem::where('id', $id)
            ->where(function ($query) use ($userGroups) {
                $query->where('access_level', 'public')
                      ->orWhereExists(function ($q) use ($userGroups) {
                          $q->select('*')
                            ->from('user_groups')
                            ->join('archive_item_user_groups', 'user_groups.id', '=', 'archive_item_user_groups.user_group_id')
                            ->whereColumn('archive_items.id', 'archive_item_user_groups.archive_item_id')
                            ->whereIn('user_groups.id', $userGroups);
                      });
            })
            ->firstOrFail();

        return view('archives.show', compact('archive'));
    }
}
