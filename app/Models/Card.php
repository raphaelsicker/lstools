<?php

namespace App\Models;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int locality_id
 * @property int order
 *
 * @property Locality locality
 * @mixin Builder
 */
class Card extends Model
{
    protected $fillable = [
        'id',
        'order',
        'locality_id',
    ];

    protected $with = ['locality'];

    public function locality(): BelongsTo
    {
        return $this->belongsTo(Locality::class);
    }
}
