<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    protected $fillable = ['user_id', 'name', 'type', 'authorized_at', 'last_active_at', 'is_trusted', 'removed_at'];

    protected function casts(): array
    {
        return ['authorized_at' => 'datetime', 'last_active_at' => 'datetime', 'is_trusted' => 'boolean', 'removed_at' => 'datetime'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
