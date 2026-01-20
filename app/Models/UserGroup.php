<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserGroup extends Model
{
    protected $fillable = [
        'name',
    ];

    public function memberships(): HasMany
    {
        return $this->hasMany(UserGroupMembership::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_group_memberships'
        )->withPivot('role')->withTimestamps();
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'owner_id')
            ->where('owner_type', 'user_group');
    }
}
