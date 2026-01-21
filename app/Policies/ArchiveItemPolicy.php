<?php

namespace App\Policies;

use App\Models\ArchiveItem;
use App\Models\User;

class ArchiveItemPolicy
{
    /**
     * Determine whether the user can view the archive item.
     */
    public function view(?User $user, ArchiveItem $item): bool
    {
        // Public archives are visible to everyone
        if ($item->isPublic()) {
            return true;
        }

        // Non-public archives require authentication
        return $user !== null;
    }
}
