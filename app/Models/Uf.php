<?php

namespace App\Models;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int id
 * @property string name
 * @property int ibge
 * @property string uf
 *
 * @property Collection cities
 * @mixin Builder
 */
class Uf extends Model
{
    protected $fillable = [
        'id',
        'name',
        'ibge',
        'uf',
    ];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
