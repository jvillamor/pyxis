<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

    #[Fillable([
        'name', 'phone', 'backup_email', 'gender', 'language', 'fun_pet_effects',
        'account_status', 'data_retention_mode', 'retention_protection_source',
        'retention_started_at', 'retention_ends_at', 'retention_grace_ends_at',
        'retention_reason', 'retention_set_by', 'password',
    ])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'phone_verified_at' => 'datetime',
            'email_verified_at' => 'datetime',
            'fun_pet_effects' => 'boolean',
            'retention_started_at' => 'datetime',
            'retention_ends_at' => 'datetime',
            'retention_grace_ends_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function administratorAccess(): HasOne
    {
        return $this->hasOne(AdministratorAccess::class);
    }

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    public function isAdministrator(): bool
    {
        return $this->administratorAccess?->status === 'active';
    }
}
