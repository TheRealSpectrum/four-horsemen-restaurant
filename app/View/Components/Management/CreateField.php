<?php

namespace App\View\Components\Management;

use App\Models\Ingredient;

use Illuminate\View\Component;

class CreateField extends Component
{
    public function __construct(
        string $name = "",
        string $label = "",
        string $value = "",
        string $type = "text"
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->type = $type;

        switch ($type) {
            case "ingredient":
                if ($this->value == "") {
                    $this->value = "[]";
                }

                $ingredients = Ingredient::orderBy("name")->get();

                $ingredientsJson = "[";

                foreach ($ingredients as $ingredient) {
                    $ingredientsJson .= $ingredient->asObjectString() . ",";
                }

                $ingredientsJson = substr($ingredientsJson, 0, -1) . "]";

                $this->display =
                    "components.management.create-field-ingredient";
                $this->displayInput = [
                    "ingredients" => $ingredientsJson,
                ];
                break;
        }
    }

    public function render()
    {
        return view($this->display, $this->displayInput);
    }

    public string $name;
    public string $label;
    public string $value;
    public string $type;

    private string $display = "components.management.create-field";
    private array $displayInput = [];
}
