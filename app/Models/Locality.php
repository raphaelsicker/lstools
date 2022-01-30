<?php

namespace App\Models;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string name
 * @property int service_group_id
 *
 * @property ServiceGroup serviceGroup
 *
 * @mixin Builder
 */
class Locality extends Model
{
    protected $fillable = [
        'id',
        'name',
        'service_group_id'
    ];

    public $orderBy = [
        'name' => 'asc'
    ];

    protected $with = [
        'serviceGroup',
        'cards'
    ];

    public function serviceGroup(): BelongsTo
    {
        return $this->belongsTo(ServiceGroup::class);
    }

    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
}
