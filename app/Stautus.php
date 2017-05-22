<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Stautus
 *
 * @package App
 * @property tinyInteger $status
 * @property tinyInteger $action_open
 * @property tinyInteger $action_black
 * @property tinyInteger $action_wait
 * @property tinyInteger $action_else
 * @property string $door
 * @property-write mixed $door_id
 * @mixin \Eloquent
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Stautus whereActionBlack($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Stautus whereActionElse($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Stautus whereActionOpen($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Stautus whereActionWait($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Stautus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Stautus whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Stautus whereDoorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Stautus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Stautus whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Stautus whereUpdatedAt($value)
 * @property bool $action
 * @method static \Illuminate\Database\Query\Builder|\App\Stautus whereAction($value)
 */
class Stautus extends Model
{
    use SoftDeletes;

    protected $fillable = ['status', 'action_open', 'action_black', 'action_wait', 'action_else', 'door_id'];
    
    public static function boot()
    {
        parent::boot();

        Stautus::observe(new \App\Observers\UserActionsObserver);

        Stautus::observe(new \App\Observers\StautusCrudActionObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setDoorIdAttribute($input)
    {
        $this->attributes['door_id'] = $input ? $input : null;
    }
    
    public function door()
    {
        return $this->belongsTo(Door::class, 'door_id')->withTrashed();
    }
    
}
