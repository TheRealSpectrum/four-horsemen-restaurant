<?php

namespace App\Management;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

final class Builder
{
    public function __construct()
    {
        $this->columns = new Collection();
        $this->inlineColumns = new Collection();
        $this->fieldsLeft = new Collection();
        $this->fieldsRight = new Collection();
        $this->changersStore = new Collection();
        $this->changersUpdate = new Collection();
        $this->manyChangersStore = new Collection();
        $this->manyChangersUpdate = new Collection();
        $this->inputQueries = new Collection();
    }

    /*
     * This function defines a column in the index page.
     *
     * @param $column The same column used in the database, used for sorting the results.
     * @param $header Displayed at the top of the index page, only descriptive.
     *
     * @param $map if set then this function will be used to determine the value that is displayed.
     * If not set the database column will be used.
     */
    public function defineColumn(
        string $column,
        string $header,
        bool $shouldSort = true,
        ?callable $map = null
    ): self {
        $this->columns->push(
            new Column(
                $column,
                $header,
                $shouldSort,
                $map !== null
                    ? $map
                    : function (model $model) use ($column) {
                        return $model->$column;
                    }
            )
        );

        return $this;
    }

    /*
     * This function defines a column in the index page, but for use with inline edits.
     *
     * @param $column The same column used in the database, used for sorting the results.
     * @param $header Displayed at the top of the index page, only descriptive.
     *
     * @param $map if set then this function will be used to determine the value that is displayed.
     * If not set the database column will be used.
     */
    public function defineInlineColumn(
        string $column,
        string $header,
        string $inputType,
        callable $defaultValue,
        bool $shouldSort = true,
        ?callable $map = null
    ): self {
        $this->inlineColumns->push(
            new InlineColumn(
                $column,
                $header,
                $inputType,
                $defaultValue,
                $shouldSort,
                $map !== null
                    ? $map
                    : function (model $model) use ($column) {
                        return $model->$column;
                    }
            )
        );

        return $this;
    }

    /*
     * This function defines a field on the left side of the.
     * This can be the show, create or edit page.
     * Uses components internally which transform the type in something useful.
     *
     * @param $column The same column used in the database, used as input for the field.
     * @param $type The type of field, which will be passed to the component.
     * @param $label Display text which labeles the current field.
     *
     * @param $map if set then this function will be used to determine the value that is displayed.
     * Only used in show page.
     * If not set the database column will be used.
     */
    public function defineFieldLeft(
        string $column,
        string $type,
        string $label,
        ?callable $map = null,
        ?callable $mapInput = null
    ): self {
        $this->defineField($column, $type, $label, $map, $mapInput, true);
        return $this;
    }

    /*
     * This function defines a field on the right side of the.
     * This can be the show, create or edit page.
     * Uses components internally which transform the type in something useful.
     *
     * @param $column The same column used in the database, used as input for the field.
     * @param $type The type of field, which will be passed to the component.
     * @param $label Display text which labeles the current field.
     *
     * @param $map if set then this function will be used to determine the value that is displayed.
     * Only used in show page.
     * If not set the database column will be used.
     */
    public function defineFieldRight(
        string $column,
        string $type,
        string $label,
        ?callable $map = null,
        ?callable $mapInput = null
    ): self {
        $this->defineField($column, $type, $label, $map, $mapInput, false);
        return $this;
    }

    /*
     * this function defines a database column that can be changed.
     * this defines changes for `store` requests.
     *
     * @param $column the column in the database which should be changed.
     * @param $validation an array of validation rules applied to the input.
     */
    public function defineChangerStore(string $column, array $validation): self
    {
        $this->changersStore->push(
            new Changer(
                $column,
                gettype($validation) === "array"
                    ? function (int $id) use ($validation) {
                        return $validation;
                    }
                    : $validation
            )
        );

        return $this;
    }

    /*
     * this function defines a database column that can be changed.
     * this defines changes for `update` requests.
     *
     * @param $column the column in the database which should be changed.
     * @param $validation an array of validation rules applied to the input.
     */
    public function defineChangerUpdate(
        string $column,
        array|callable $validation
    ): self {
        $this->changersUpdate->push(
            new Changer(
                $column,
                gettype($validation) === "array"
                    ? function ($id) use ($validation) {
                        return $validation;
                    }
                    : $validation
            )
        );

        return $this;
    }

    public function defineManyChangerStore(
        string $model,
        string $relation,
        string $prefix,
        array $properties
    ) {
        $this->manyChangersStore->push(
            new ManyChanger($model, $relation, $prefix, $properties)
        );

        return $this;
    }

    public function defineManyChangerUpdate(
        string $model,
        string $relation,
        string $prefix,
        array $properties
    ) {
        $this->manyChangersUpdate->push(
            new ManyChanger($model, $relation, $prefix, $properties)
        );

        return $this;
    }

    /*
     * @todo remove this function and use vue+api calls instead.
     */
    public function withInputQuery(string $name, callable $callback): self
    {
        $this->inputQueries->push([$name, $callback]);
        return $this;
    }

    public Collection $columns;
    public Collection $inlineColumns;
    public Collection $fieldsLeft;
    public Collection $fieldsRight;
    public Collection $changersStore;
    public Collection $changersUpdate;
    public Collection $manyChangersStore;
    public Collection $manyChangersUpdate;
    public Collection $inputQueries; // todo: remove this

    private function defineField(
        string $column,
        string $type,
        string $label,
        ?callable $map,
        ?callable $mapInput,
        bool $isLeft
    ): void {
        ($isLeft ? $this->fieldsLeft : $this->fieldsRight)->push(
            new Field(
                $column,
                $type,
                $label,
                $map !== null
                    ? $map
                    : function (Model $model) use ($column) {
                        return $model->$column;
                    },
                $mapInput !== null
                    ? $mapInput
                    : function (Model $model) use ($column) {
                        return $model->$column;
                    }
            )
        );
    }
}
