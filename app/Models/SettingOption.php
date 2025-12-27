<?php
/**
 * Model for Setting Options/Categories
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingOption extends Model
{
    /** @use HasFactory<\Database\Factories\SettingCategoryFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = "db_words.users_settings_options";

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new ActiveScope);
    }
}
