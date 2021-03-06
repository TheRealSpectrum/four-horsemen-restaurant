<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\{SiteGlobal, GlobalUnit};

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use Barryvdh\Debugbar\Facade as DebugBar;

use App\Management\Advanced\{Group, Setting, Updater};

final class AdvancedController extends Controller
{
    public function index(): View
    {
        $groups = $this->generateGroups();
        return view("management.advanced.index", [
            "groups" => $groups,
            "groupsData" => $groups
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

        $globalUnits = GlobalUnit::all();
        $globalUnitsString = str_replace(
            "\"",
            "'",
            json_encode(
                $globalUnits
                    ->map(function (GlobalUnit $unit) {
                        return [
                            "id" => $unit->id,
                            "name" => $unit->name,
                            "status" => "update",
                        ];
                    })
                    ->toArray()
            )
        );

        $result = new Collection();
        $result->push(
            new Group("Settings", function (Collection $settings) use (
                $siteGlobal,
                $globalUnitsString
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

                $settings->push(
                    new Setting(
                        "Ingredient Units",
                        // prettier-ignore
                        <<<VUE
                        <management-list-input
                            name="ingredient-units"
                            :default-value="{$globalUnitsString}"
                            :default-new="{id: 0, name: '', status: 'create'}"
                            label="Ingredient Units"
                        >
                            <template slot-scope="props">
                                <input type="string" :value="props.getValue().name" 
                                    :disabled="props.getValue().status === 'delete'"
                                    :class="{'text-mono-dark': props.getValue().status === 'delete'}"
                                    @input="props.setValue({id: props.getValue().id, name: \$event.target.value, status: props.getValue().status})"/>

                                <action-button v-if="props.getValue().status !== 'delete'" level="low"
                                    @click-action="props.setValue({id: props.getValue().id, name: props.getValue().name, status: 'delete'})">
                                        Delete unit
                                    </action-button>
                                <action-button v-else level="safe"
                                    @click-action="props.setValue({id: props.getValue().id, name: props.getValue().name, status: props.getValue().id === 0 ? 'create' : 'update'})">
                                        Undo Delete
                                    </action-button>
                            </template>
                        </management-list-input>
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

        yield new Updater("ingredient-units", function ($value) {
            DB::transaction(function () use ($value) {
                foreach ($value as $unitValue) {
                    switch ($unitValue["status"]) {
                        case "update":
                            $unit = GlobalUnit::where(
                                "id",
                                $unitValue["id"]
                            )->firstOrFail();
                            $unit->name = $unitValue["name"] ?? "";
                            $unit->save();
                            break;

                        case "create":
                            GlobalUnit::create([
                                "name" => $unitValue["name"] ?? "",
                            ]);
                            break;
                        case "delete":
                            if ($unitValue["id"] === 0) {
                                break;
                            }
                            GlobalUnit::where("id", $unitValue["id"])->delete();
                            break;
                    }
                }
            });
        });
    }
}
