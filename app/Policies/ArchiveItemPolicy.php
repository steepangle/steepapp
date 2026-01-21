<?php

namespace App\Policies;

use App\Models\ArchiveItem;
use App\Models\User;

public function view(?User $user, ArchiveItem $archive): bool
{
    // 1. Public access
    if ($archive->access_level === 'public') {
        return true;
    }

    // 2. Guest cannot access non-public
    if (!$user) {
        return false;
    }

    // 3. Direct group access
    return $archive->userGroups()
        ->whereIn(
            'user_groups.id',
            $user->userGroups->pluck('id')
        )
        ->exists();
}

