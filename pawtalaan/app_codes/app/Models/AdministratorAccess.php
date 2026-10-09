<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdministratorAccess extends Model
{
    protected $fillable = ['user_id', 'role', 'status', 'granted_by', 'granted_at', 'revoked_at', 'last_admin_login_at'];

    protected function casts(): array
    {
        return ['granted_at' => 'datetime', 'revoked_at' => 'datetime', 'last_admin_login_at' => 'datetime'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
