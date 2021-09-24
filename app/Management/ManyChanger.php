<?php

namespace App\Management;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

final class ManyChanger
{
    public function __construct(
        string $model,
        string $relation,
        string $prefix,
        array $properties
    ) {
        $this->model = $model;
        $this->relation = $relation;
        $this->prefix = $prefix;
        $this->properties = $properties;
    }

    public function LinkToModel(Model $owner, int $id, array $properties): void
    {
        $relation = $this->relation;
        $owner->$relation()->attach($id, $properties);
    }

    public function detachAll(Model $owner): void
    {
        $relation = $this->relation;
        $owner->$relation->each(function (Model $model) use (
            $owner,
            $relation
        ) {
            $owner->$relation()->detach($model->id);
        });
    }

    public string $model;
    public string $relation;
    public string $prefix;
    public array $properties;
}
