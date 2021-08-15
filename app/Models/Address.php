<?php

namespace App\Models;

use App\Models\Base\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street',
        'number',
        'complement',
        'reference',
        'district',
        'latitude',
        'longitude',
        'city_id',
    ];

    protected $with = ['city'];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
