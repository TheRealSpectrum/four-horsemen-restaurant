<?php

namespace App\Http\Controllers\Management;

use App\Models\Category;
use App\Management\Builder as ManagementBuilder;

final class CategoriesController extends ManagementController
{
    protected function managementInit(ManagementBuilder $builder): void
    {
        $builder
            ->defineColumn("name", "Name", true)
            ->defineColumn("type", "Type", true);

        $builder
            ->defineFieldLeft("name", "text", "Name")
            ->defineFieldLeft("type", "type", "Type");

        $builder
            ->defineChangerStore("name", [
                "required",
                "string",
                "unique:App\Models\Category,name",
            ])
            ->defineChangerStore("type", ["required"]);

        $builder
            ->defineChangerUpdate("name", [
                "required",
                "string",
                "unique:App\Models\Category,name, ",
            ]) // TODO add id to unique validation
            ->defineChangerUpdate("type", ["required"]);
    }

    protected string $managementModel = Category::class;
    protected string $managementName = "categories";
    protected string $managementParameterName = "category";
    protected string $defaultOrderColumn = "name";
}
