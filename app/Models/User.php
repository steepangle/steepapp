<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    protected $fillable = [
        'a_id',
        'username',
        'email',
        'password_hash',
        'status',
    ];

    protected $hidden = [
        'password_hash',
    ];

    public function groupMemberships(): HasMany
    {
        return $this->hasMany(UserGroupMembership::class);
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            UserGroup::class,
            'user_group_memberships'
        )->withPivot('role')->withTimestamps();
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'owner_id')
            ->where('owner_type', 'user');
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

}
