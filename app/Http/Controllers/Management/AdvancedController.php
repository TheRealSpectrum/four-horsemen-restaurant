<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\SiteGlobal;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use Barryvdh\Debugbar\Facade as DebugBar;

use App\Management\Advanced\{Group, Setting, Updater};

final class AdvancedController extends Controller
{
    public function index(): View
    {
        return view("management.advanced.index", [
            "groups" => $this->generateGroups()
                ->map(function (Group $group) {
                    return $group->getData();
                })
                ->toArray(),
        ]);
    }

    public function update(Request $request, string $setting): JsonResponse
    {
        foreach ($this->generateUpdates() as $update) {
            if ($setting === $update->name) {
                ($update->callback)($request->get("data"));
                return response()->json(["success" => true]);
            }
        }
        return response()->json(["success" => false]);
    }

    private function generateGroups(): Collection
    {
        SiteGlobal::firstOrCreate([]);

        $siteGlobal = SiteGlobal::firstOrFail();

        $result = new Collection();
        $result->push(
            new Group("Settings", function (Collection $settings) use (
                $siteGlobal
            ) {
                $settings->push(
                    new Setting(
                        "Markup",
                        //prettier-ignore
                        <<<VUE
                           <management-input
                           type="number"
                           name="markup-dishes"
                           default-value="{$siteGlobal->markup_dishes}"
                           >Dishes Markup (%)</management-input>

                           <management-input
                           type="string"
                           name="markup-drinks"
                           default-value="{$siteGlobal->markup_drinks}"
                           >Drinks Markup (%)</management-input>
                           VUE
                    )
                );
            })
        );
        return $result;
    }

    private function generateUpdates(): \Generator
    {
        yield new Updater("markup-dishes", function ($value) {
            SiteGlobal::updateOrCreate([], ["markup_dishes" => $value]);
        });

        yield new Updater("markup-drinks", function ($value) {
            SiteGlobal::updateOrCreate([], ["markup_drinks" => $value]);
        });
    }
}
