<?php

namespace App\Models\Base;

use App\Helpers\Arr;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 * @method static count()
 */
abstract class Model extends \Illuminate\Database\Eloquent\Model
{
    protected $filterable = [];

    public function makeSearch(
        Model | Builder $query,
        string $string
    ): Builder {
        $query->where(function (Builder $query) use ($string) {
            foreach($this->getFillable() as $field) {
                $query->orWhere($field, 'like', "%{$string}%");
            }
        });

        return $query;
    }

    public function makeFilter(
        Model | Builder $query,
        array | string $filters
    ): Builder {
        if(gettype($filters) === 'string') {
            $filters = json_decode($filters, true);
        }

        $table = $query->getTable();

        foreach($filters as $key => $val) {
            $query = $this->addWhere($query, $table, $key, $val);
        }

        return $query->select($table . '.*');
    }

    private function addWhere(
        Model | Builder $query,
        string $table,
        string $key,
        mixed $val
    ): Builder {
        if(!is_array($val)) {
            return $query->where($table . '.' . $key, $val);
        }

        $filters = $val;
        $relation = $query->getRelation($key);
        $relationTable = $relation->getBaseQuery()->from;

        $query->join(
            $relationTable,
            $relation->getQualifiedForeignKeyName(),
            $relation->getQualifiedOwnerKeyName()
        );

        foreach($filters as $key => $val) {
            $query = $this->addWhere($query, $relationTable, $key, $val);
        }
        return $query;
    }

    public static function createMany(array $items): array
    {
        foreach($items ?? [] as $item) {
            $created[] = self::create($item);
        }

        return $created ?? [];
    }

    public static function store(array $data): Model
    {
        $key = (new static())->getKeyName();

        if(!$model = self::find($data[$key] ?? null)) {
            return self::create($data);
        }

        $model->fill($data)->save();
        $model->fresh();
        return $model;
    }
}
