<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
