<?php

namespace App\Models;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property int locality_id
 * @property int order
 *
 * @property Locality locality
 * @property Collection adressess
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

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
