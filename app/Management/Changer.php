<?php

namespace App\Management;

final class Changer
{
    public function __construct(string $column, callable $validation)
    {
        $this->column = $column;
        $this->validation = $validation;
    }

    public function getValidationRules(int $id)
    {
        return ($this->validation)($id);
    }

    public string $column;
    private $validation;
}
