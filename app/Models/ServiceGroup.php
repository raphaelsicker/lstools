<?php

namespace App\Models;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int id
 * @property string name
 * @property string shortname
 * @property string color
 *
 * @mixin Builder
 */
class ServiceGroup extends Model
{
    protected $fillable = [
        'id',
        'name',
        'shortname',
        'color'
    ];

    public $orderBy = [
        'name' => 'asc'
    ];
}
