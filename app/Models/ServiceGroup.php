<?php

namespace App\Models;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string name
 * @property string shortname
 * @property string color
 *
 * @property Collection localities
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

    public function localities(): HasMany
    {
        return $this->hasMany(Locality::class);
    }
}
