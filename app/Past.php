<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Past
 *
 * @package App
 * @property string $action
 * @property string $door
 * @property tinyInteger $intruder
 * @property string $user
 * @property-write mixed $door_id
 * @property-write mixed $user_id
 * @mixin \Eloquent
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Past whereAction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Past whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Past whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Past whereDoorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Past whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Past whereIntruder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Past whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Past whereUserId($value)
 */
class Past extends Model
{
    use SoftDeletes;

    protected $fillable = ['action', 'name', 'intruder', 'door_id', 'user_id'];

    public static function boot()
    {
        parent::boot();

        Past::observe(new \App\Observers\UserActionsObserver);

        Past::observe(new \App\Observers\PastCrudActionObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDoorIdAttribute($input)
    {
        $this->attributes['door_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }

    public function door()
    {
        return $this->belongsTo(Door::class, 'door_id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
