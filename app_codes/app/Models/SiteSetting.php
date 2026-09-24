<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'value_type', 'group', 'label', 'description', 'is_sensitive', 'updated_by'];

    protected function casts(): array
    {
        return ['is_sensitive' => 'boolean'];
    }
}
