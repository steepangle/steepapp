<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ArchiveItem;

class ArchiveItemPolicy
{
    /**
     * Determine whether the user can view the archive item.
     */
    public function view(User $user, ArchiveItem $item): bool
    {
        // Public archive items
        if ($item->access_level === 'public') {
            return true;
        }

        // User-level private access
        if ($item->access_level === 'user') {
            return true;
        }

        // Group-based access
        if ($item->access_level === 'group') {
            return $user->groups()->exists();
        }

        return false;
    }
}
