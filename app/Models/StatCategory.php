<?php
/**
 * Model for Stat Categories
 */

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatCategory extends Model
{
    /** @use HasFactory<\Database\Factories\StatsCategoriesFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = "db_words.tbl_stats_categories";

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new ActiveScope);
    }
}
