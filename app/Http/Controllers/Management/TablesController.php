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
            ->defineColumn("id", "Table Number")
            ->defineColumn("seat_count", "Available Seats");
    }

    protected string $managementModel = Table::class;
    protected string $managementName = "tables";
    protected string $managementParameterName = "table";
    protected string $orderByColumn = "id";
    protected bool $editInline = true;
}
