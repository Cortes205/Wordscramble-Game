<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingOption extends Model
{
    /** @use HasFactory<\Database\Factories\SettingCategoryFactory> */
    use HasFactory;

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new ActiveScope);
    }
}
