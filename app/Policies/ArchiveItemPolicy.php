<?php

namespace App\Policies;

use App\Models\ArchiveItem;
use App\Models\User;

class ArchiveItemPolicy
{
    /**
     * Determine whether the user can view the archive item.
     */
    public function view(?User $user, ArchiveItem $archive): bool
    {
        // Public archives are always visible
        if ($archive->access_level === 'public') {
            return true;
        }

        // Private archives require authentication
        if (!$user) {
            return false;
        }

        // User must belong to at least one allowed group
        return $archive->userGroups()
            ->whereIn('user_groups.id', $user->userGroups->pluck('id'))
            ->exists();
    }

    public function show(ArchiveItem $archive)
    {
        $user = Auth::user();
        $allowedGroups = $user ? $user->userGroups->pluck('id') : collect();

        if (
            $archive->access_level === 'private' &&
            !$archive->userGroups->pluck('id')->intersect($allowedGroups)->count()
        ) {
            abort(403, 'Unauthorized');
        }

        return response()->file(storage_path('app/' . $archive->file_path));
    }
}

