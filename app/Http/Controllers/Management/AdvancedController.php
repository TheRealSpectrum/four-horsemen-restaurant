<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Collection;

use App\Management\Advanced\{Group, Setting};

final class AdvancedController extends Controller
{
    public function __construct()
    {
        $this->groups = new Collection();
        $this->groups->push(
            new Group("Markup", function (Collection $settings) {
                $settings->push(
                    new Setting("Dishes", "<action-button>hey</action-button>")
                );
                $settings->push(new Setting("Drinks", "bye"));
            })
        );
    }

    public function index(): View
    {
        return view("management.advanced.index", [
            "groups" => $this->groups
                ->map(function (Group $group) {
                    return $group->getData();
                })
                ->toArray(),
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        return response()->json();
    }

    private Collection $groups;
}
