<?php
/**
 * Model for stats belonging to Users
 */

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    /** @use HasFactory<\Database\Factories\StatsFactory> */
    use HasFactory;

    protected $table = "db_words.tbl_stats";

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new ActiveScope);
    }

    public function user() {
        return $this->belongsTo(User::class, "fk_user_id", "id");
    }

    public function category() {
        return $this->belongsTo(StatCategory::class, "fk_stats_category", "id");
    }
}
