<?php

namespace App\Models;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int id
 * @property string name
 * @mixin Builder
 */
class Locality extends Model
{
    protected $fillable = [
        'id',
        'name',
    ];

    public $orderBy = [
        'name' => 'asc'
    ];
}
