<?php

namespace App\Models;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string name
 * @property int ibge
 * @property int uf_id
 *
 * @property Uf uf
 * @method static Builder name(string $string)
 */
class City extends Model
{
    protected $fillable = [
        'id',
        'name',
        'ibge',
        'uf_id'
    ];

    public $orderBy = [
        'name' => 'asc'
    ];

    protected $filterable = [Uf::class];

    protected $with = ['uf'];

    public function uf(): BelongsTo
    {
        return $this->belongsTo(Uf::class);
    }

    public function scopeName(Builder $query, string $name): Builder
    {
        return $query->where('name', $name);
    }
}
