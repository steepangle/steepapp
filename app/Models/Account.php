<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Account extends Model
{
    protected $fillable = [
        'tban',
        'owner_type',
        'owner_id',
    ];

    public function owner(): MorphTo
    {
        return $this->morphTo(null, 'owner_type', 'owner_id');
    }

    public function outgoingTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'from_account_id');
    }

    public function incomingTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'to_account_id');
    }
}
