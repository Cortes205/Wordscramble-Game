<?php
/**
 * Model for Stat Categories
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Auth;
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

    /**
     * Relationship of Stat Categories to their Stats
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Stat, StatCategory>
     */
    public function stats() {
        return $this->hasMany(Stat::class, "fk_stats_category", "id");
    }

    /**
     * Relationship of Stat Categories to their Stats for the current User
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Stat, StatCategory>
     */
    public function userStats() {
        /**
         * @var User
         */
        $user = Auth::getUser();

        return $this->hasMany(Stat::class, "fk_stats_category", "id")
            ->where("fk_user_id", $user->id);
    }

    /**
     * Relationship of Stat Categories to the latest stat for the current User
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne<Stat, StatCategory>
     */
    public function latestUserStat() {
        /**
         * @var User
         */
        $user = Auth::getUser();

        return $this->hasOne(Stat::class, "fk_stats_category", "id")
            ->where("fk_user_id", $user->id)
            ->latestOfMany("created_at");
    }
}
