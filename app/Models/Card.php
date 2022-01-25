<?php

namespace App\Models;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int locality_id
 * @property int service_group_id
 * @property int order
 *
 *
 * @mixin Builder
 */
class Card extends Model
{
    protected $fillable = [
        'id',
        'order',
        'locality_id',
        'service_group_id',
    ];

    public function locality(): BelongsTo
    {
        return $this->belongsTo(Locality::class);
    }

    public function serviceGroup(): BelongsTo
    {
        return $this->belongsTo(ServiceGroup::class);
    }
}
