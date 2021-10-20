<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 * @method static count()
 */
abstract class Model extends \Illuminate\Database\Eloquent\Model
{
    public function makeSearch(Builder $query, string $string): Builder
    {
        $query->where(function (Builder $query) use ($string) {
            foreach($this->getFillable() as $field) {
                $query->orWhere($field, 'like', "%{$string}%");
            }
        });

        return $query;
    }
}
