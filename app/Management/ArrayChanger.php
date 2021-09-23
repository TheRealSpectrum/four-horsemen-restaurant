<?php

namespace App\Management;

final class ArrayChanger
{
    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    public string $prefix;
}
