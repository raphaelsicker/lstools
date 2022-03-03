<?php

namespace App\Models;

use App\Helpers\Str;
use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $street
 * @property string $number
 * @property string $complement
 * @property string $reference
 * @property string $district
 * @property string $lat
 * @property string $lng
 * @property string $complete
 * @property int city_id
 * @property int card_id
 *
 * @property City city
 * @property Card card
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'complement',
        'reference',
        'district',
        'lat',
        'lng',
        'city_id',
        'card_id'
    ];

    public $orderBy = [
        'street' => 'asc'
    ];

    protected $with = [
        'city',
        'card'
    ];

    public $appends = ['complete'];

    public function getCompleteAttribute(): string
    {
        return $this->attributes['complete'] = $this->street
            . Str::addPrefix($this->number, ', ')
            . Str::addPrefix($this->complement, ' - ')
            . Str::addPrefix($this->district, ' - ');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
