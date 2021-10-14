<?php

namespace App\Http\Controllers\Management;

use App\Models\Table;
use App\Management\Builder as ManagementBuilder;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TablesController extends ManagementController
{
    protected function managementInit(ManagementBuilder $builder): void
    {
        $builder
            ->defineInlineColumn("id", "Table Number", "number", function () {
                if (Table::count() == 0) {
                    return 1;
                }

                return Table::orderBy("id", "desc")->value("id") + 1;
            })
            ->defineInlineColumn(
                "seat_count",
                "Available Seats",
                "number",
                function () {
                    return 1;
                }
            );

        $builder
            ->defineChangerStore("id", ["required", "numeric", "min:1"])
            ->defineChangerStore("seat_count", [
                "required",
                "numeric",
                "min:1",
            ]);

        $builder
            ->defineChangerUpdate("id", ["filled", "numeric", "min:1"])
            ->defineChangerUpdate("seat_count", ["filled", "numeric", "min:1"]);
    }

    protected string $managementModel = Table::class;
    protected string $managementName = "tables";
    protected string $managementParameterName = "table";
    protected string $orderByColumn = "id";
    protected bool $editInline = true;
}
