<?php

namespace App\Management;

final class Changer
{
    public function __contruct(string $column, array $validation)
    {
        $this->column = $column;
        $this->validation = $validation;
    }

    public string $column;
    public array $validation;
}
