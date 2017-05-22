<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Door
 *
 * @package App
 * @property string $door_key
 * @property string $location
 * @property int $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Door whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Door whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Door whereDoorKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Door whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Door whereLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Door whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Door extends Model
{
    use SoftDeletes;

    protected $fillable = ['door_key', 'location'];
    
    public static function boot()
    {
        parent::boot();

        Door::observe(new \App\Observers\UserActionsObserver);

        Door::observe(new \App\Observers\DoorCrudActionObserver);
    }
    
}
