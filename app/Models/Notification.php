<?php
/**
 * Model for Notifications
 * 
 * @author      Alan Cortes
 * @version     1.0.0
 */

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string|null
     */
    protected $table = "db_words.users_notifications";

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActiveScope);
    }

    /**
     * Add id condition to the query
     * 
     * @param Builder $query
     * @param int $id
     * 
     * @return void
     */
    protected function scopeOfId(Builder $query, int $id)
    {
        $query->where("id", $id);
    }

    /**
     * Add user id condition to the query
     * 
     * @param Builder $query
     * @param User $user
     * 
     * @return void
     */
    protected function scopeOfUser(Builder $query, User $user)
    {
        $query->where("fk_user_id", $user->id);
    }

    /**
     * Relationship of Notifications to a User
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Notification>
     */
    public function user()
    {
        return $this->belongsTo(User::class, "fk_user_id", "id");
    }
}
