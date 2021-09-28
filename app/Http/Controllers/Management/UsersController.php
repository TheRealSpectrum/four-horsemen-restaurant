<?php

namespace App\Http\Controllers\Management;

use App\Models\User;
use App\Management\Builder as ManagementBuilder;

use Illuminate\Http\Request;

class UsersController extends ManagementController
{
    protected function managementInit(ManagementBuilder $builder): void
    {
        $builder->defineColumn("name", "Name")->defineColumn("email", "Email");

        $builder
            ->defineFieldLeft("name", "text", "Name")
            ->defineFieldLeft("email", "email", "Email");

        $builder
            ->defineChangerStore("name", ["required", "min:2"])
            ->defineChangerStore("email", ["required", "email"]);

        $builder
            ->defineChangerUpdate("name", ["filled", "min:2"])
            ->defineChangerUpdate("email", ["filled", "email"]);
    }

    protected string $managementModel = User::class;
    protected string $managementName = "employees";
    protected string $managementParameterName = "employee";
}
