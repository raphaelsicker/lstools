<?php

namespace App\Models;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string name
 * @property int service_group_id
 *
 * @property ServiceGroup serviceGroup
 * @property Collection cards
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

    public $orderBy = ['name' => 'asc'];
    public $appends = ['cards_length'];
    protected $with = ['serviceGroup'];

    public function serviceGroup(): BelongsTo
    {
        return $this->belongsTo(ServiceGroup::class);
    }

    public function cards($withRelations = true): HasMany
    {
        $cards = $this->hasMany(Card::class);

        return $withRelations
            ? $cards
            : $cards->without(['locality']);
    }

    public function getCardsLengthAttribute(): int
    {
        return $this->attributes['cards_lenght'] = $this->cards()->count();
    }
}
