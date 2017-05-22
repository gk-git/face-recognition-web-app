<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Support
 *
 * @property-read \App\Door $door
 * @property-write mixed $door_id
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $message
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Support whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Support whereDoorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Support whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Support whereMessage($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Support whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Support whereUpdatedAt($value)
 */
class Support extends Model
{
    //
    use SoftDeletes;

    protected  $table= "supports";

    protected $fillable = [
        'name'
        ,'message'
        ,'door_id'
    ];

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
